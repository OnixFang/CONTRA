<?php namespace App\Console\Commands;

use App\Carrera;
use App\CicloTipo;
use App\Pensum;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use phpDocumentor\Reflection\Types\String_;

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
//        try{

        $client = new Client([
            'allow_redirects' => true,
            'timeout'  => 30,
            'http_errors' => false
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
                            return (strip_tags(trim($element)));
                        });

                        $subject = [
                            'descripcion' => $data[1],
                            'clave' => $this->formatKey($data[0]),
                            'hp' => $data[3],
                            'ht' => $data[2],
                            'cr' => $data[6],
                            'cuatrimestre' => $key,
                            'propedeutico' => (strpos($data[1],'Propedéutico') !== false) ? 1 : 0,
                        ];

                        var_dump($subject);
                    }
                });
            });
            dd('Termine');
        });

//        } catch (RequestException $exception) {
//            Log::error($exception->getMessage());
//            $this->error($exception->getMessage());
//        }catch (Exception $exception){
//            Log::error($exception->getMessage());
//            $this->error($exception->getMessage());
//        }
    }

    private function formatKey($key)
    {
        if(strpos($key,'-') == false)
            $key = substr($key, 0, 3) . "-" . substr($key, 3, strlen($key));

        return $key;
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
