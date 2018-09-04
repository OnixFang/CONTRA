<?php namespace App\Console\Commands;

use App\Asignatura;
use App\Carrera;
use App\CicloTipo;
use App\Pensum;
use DB;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Exception;

class ParserPensum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:pensum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        try{
            $entry_point = config("parsers.{$this->signature}.entry_point");
            $this->info(config($entry_point));

            $client = new Client([
                'base_uri' => config('parsers.parser:pensum.domain'),
                'allow_redirects' => true,
                'timeout'  => 30,
            ]);

            $response = $client->request('get', config('parsers.parser:pensum.entry_point'));


            if($response->getStatusCode() !== 200 and $response->getReasonPhrase() !== 'OK')
                throw new Exception($entry_point . config('parsers.parser:pensum.domain') . " not found.");

            $dom = $response->getBody()->getContents();
            $section = collect(parse_array($dom, '<section class="section-padding" id="oferta-academica">', '</section>'))->first();

            $pensums_url = $this->collectCareers($section);

            $this->collectPensums($pensums_url);

        } catch (RequestException $exception) {
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());
        }


    }

    private function collectPensums(Collection $pensums_url)
    {
        try{

            $client = new Client([
                'allow_redirects' => true,
                'timeout'  => 30,
                'http_errors' => false,
                'headers' => [
                    'User-Agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                ]
            ]);

            $cicle_types = CicloTipo::all()->pluck('id', 'descripcion');

            $pensums_url->map(function ($element) use($client, $cicle_types)
            {
                $response = $client->request('get', $element['url']);

                if($response->getStatusCode() !== 200 and $response->getReasonPhrase() !== 'OK')
                    return $this->exception($element['url'] . " not found.");

                $this->info($element['url']);

                $dom = $response->getBody()->getContents();

                $pensum_description = '';
                preg_match('/\Wpensum(.+)(\d{4})\W/i', $dom,$pensum_description);
                $pensum_description = ucwords(str_replace(['>', '<', '/'], ['', '', ''], trim(collect($pensum_description)->first())));
                $pensum_description = (empty($pensum_description)) ? 'Version inicial' : $pensum_description;

                $cicle_type_id = 0;
                foreach ($cicle_types as $key => $value)
                    if (stripos($dom, $key) !== false) {
                        $cicle_type_id = $cicle_types[$key];
                        break;
                    }

                $pensum = Pensum::updateOrCreate(
                    ['carrera_id' => $element['carrera_id'], 'descripcion' => $pensum_description, 'ciclo_tipo_id' => $cicle_type_id],
                    ['carrera_id' => $element['carrera_id'], 'descripcion' => $pensum_description, 'ciclo_tipo_id' => $cicle_type_id]
                );

                $article = collect(parse_array($dom, '<article id="post-', '</article>'))->first();
                if($article == null)
                    return $this->exception("Article not found. {$element['url']}");

                $quarters = collect(parse_array($article, '<table', '</table>'));
                if($quarters->count() == 0)
                    return $this->exception("Table for quarters not found. {$element['url']}");

                $quarters->each(function ($quarter, $key) use($element, $pensum) {
                    $subjects = collect(parse_array($quarter, '<tr>', '</tr>'));
                    if($subjects->count() == 0)
                        return false;

                    $subjects->each(function ($subject) use($key, $pensum) {
                        $data = collect(parse_array($subject, '<td', '</td>'));

                        if($data->count() == 8)
                        {
                            $data = $data->map(function ($element) {
                                return trim(html_entity_decode(strip_tags(preg_replace(['/\s+/', '/\ /'], [' ', ''], $element))));
                            });

                            $clave = $this->formatKey($data[0]);
                            if((empty($data[1]) == false or (bool)strlen($data[1]) == true) and strlen($data[0]) >= Asignatura::KEY_LEN)
                            {
                                $subject = Asignatura::updateOrCreate(['clave' => $this->formatKey($data[0])], [
                                    'descripcion' => preg_replace('/\s+/', ' ', (trim($data[1]))),
                                    'clave' => $clave,
                                    'hp' => (integer)str_replace(['', '–', '-'], 0, (trim($data[3]))),
                                    'ht' => (integer)str_replace(['', '–', '-'], 0, (trim($data[2]))),
                                    'cr' => (integer)str_replace(['', '–', '-'], 0, (trim($data[6]))),
                                    'cuatrimestre' => ++$key,
                                    'propedeutico' => (stripos($data[1], 'propedéutico') !== false) ? 1 : 0,
                                ]);

                                $pensum->asignaturas()->attach($subject->id);

                                $requirements = collect(explode(',', html_entity_decode(trim($data[7]))))->map(function ($requirement) use ($subject) {
                                    $clave = $this->formatKey($requirement);
                                    $subject_requirement = Asignatura::where('clave', $clave)->first();
                                    if ($subject_requirement !== null)
                                        $subject->requisitos()->attach($subject_requirement->id);
                                });
                            }
                        }
                    });
                });
            });

        } catch (RequestException $exception) {
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());
        }
    }

    private function formatKey($key)
    {
        $key = preg_replace('/\W/', '', $key);
        $key = substr($key, 0, 3) . "-" . substr($key, 3, strlen($key));
        return trim($key);
    }

    private function exception($message)
    {
        Log::error($message);
        $this->error($message);
        return false;
    }

    private function collectCareers(String $section)
    {
        $pensums = collect(parse_array($section, '<a href', '</a>'))->map(function ($element) {
            $career = preg_replace('/\s+/', ' ',trim(html_entity_decode(return_between($element, '>', '<', 'EXCL'))));
            $career = Carrera::updateOrCreate(['descripcion' => $career], ['descripcion' => $career]);

            $element = preg_replace('/\s+/', '', trim($element));
            return ['carrera_id' => $career->id, 'url' => get_attribute($element, "href")];
        });

        return $pensums;
    }
}
