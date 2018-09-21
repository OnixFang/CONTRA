<?php namespace App\Services;

use App\Carrera;
use App\Inscripcion;
use DB;
use Exception;
use File;
use Illuminate\Support\Collection;
use Log;

class HTTPRequestService
{
    public function sendLoginRequest($login_data)
    {
        $status = false;

        try{
            $url = config('parsers.platform.domain') . config('parsers.platform.services.login');
            $response = http_post_form($url, '', $login_data);

            if($response['STATUS']['url'] == config('parsers.platform.domain') . config('parsers.platform.services.default') and $response['STATUS']['http_code'] == 200)
                $status = true;

        } catch (Exception $exception){
            Log::error($exception->getMessage());
        }

        return $status;
    }

    public function sendLogoutRequest()
    {
        $url = config('parsers.platform.domain') . config('parsers.platform.services.logout');
        http_get($url, '');
        $this->eraseCookie();
    }

    public function extractLoginInformation()
    {
        $information = [];
        try{
            $this->eraseCookie();
            $url = config('parsers.platform.domain') . config('parsers.platform.services.login');
            $response = http_get($url, null);

            if($response['STATUS']['http_code'] !== 200)
                throw new Exception(get_status_code($response['STATUS']['http_code']), $response['STATUS']['http_code']);

            $dom = $response['FILE'];
            $inputs = parse_array($dom, '<input', '>');

            if((bool)count($inputs) == true)
                $information += ['__EVENTARGUMENT' => '',
                    '__EVENTTARGET' =>'',
                    '__EVENTVALIDATION'	=> '',
                ];

            foreach ($inputs as $input)
            {
                $name = get_attribute($input, 'name');
                if($name !== 'btnNewUser')
                {
                    $value = (stripos($input, 'value') !== false) ? get_attribute($input, 'value') : '';
                    $information[$name] = $value;
                }

            }

        } catch (Exception $exception){
            Log::error($exception->getMessage());
        }

        return $information;
    }

    /**
     * @param bool $return_rating
     * @return Collection
     */
    public function extractRatingHistory($return_rating = true)
    {
        $params = ['__EVENTARGUMENT' => '', '__EVENTTARGET' => 'ConHist'];
        $results = Collection::make(['career' => null, 'cycles' => collect([])]);
        try{
            $url_default = config('parsers.platform.domain') . config('parsers.platform.services.default');

            $response = http_get($url_default, null);

            if($response['STATUS']['http_code'] !== 200)
                throw new Exception(get_status_code($response['STATUS']['http_code']), $response['STATUS']['http_code']);

            $inputs = parse_array($response['FILE'], '<input', '>');

            $params += $this->convertInputToArray($inputs);

            $response = http_post_form($url_default, $url_default, $params);

            if($response['STATUS']['http_code'] !== 200)
                throw new Exception(get_status_code($response['STATUS']['http_code']), $response['STATUS']['http_code']);

            $html = $response['FILE'];

            $career = strip_tags(trim(Collection::make(parse_array($html, '<td class="ColNormal" colspan="8">', '</td>'))->first()));

            $results->put('career', $career);

            if($return_rating)
//                Collection::make(parse_array($response['FILE'], '<tr>(\W+)<td align="center" style="white-space:nowrap;">\w{4}\-\w', '<td class="ColHead">'))->each(function ($block) use($results) {
                Collection::make(parse_array($response['FILE'], '<tr>(\W+)<td align="center" style="white-space:nowrap;">\w{4}\-\w', '<td class="ColNormal" align="right"'))->each(function ($block) use($results) {
                    $data = ['key' => null, 'subjects' => []];
                    $data['key'] = strip_tags(trim(Collection::make(parse_array($block, '<td align="center" style="white-space:nowrap;">\w{4}\-\w', '<'))->first()));

                    $data['subjects'] = Collection::make(parse_array($block, '<tr', '</tr>'))->map(function ($tr) {
                        $tds = Collection::make(parse_array($tr, '<td', '</td>'));
                        if($tds->count() == 9)
                            return $tds->map(function ($td, $key) {
                                if($key > 0)
                                    return trim(strip_tags($td));
                            });
                    });

                    $results->get('cycles')->push($data);
                });

        } catch (Exception $exception){
            Log::error($exception->getMessage());
            $this->error($exception->getMessage());
            DB::rollBack();
        }

        return $results;
    }

    private function convertInputToArray($inputs, $except = [])
    {
        $data = [];

        foreach ($inputs as $input)
        {
            $name = get_attribute($input, 'name');
            if(in_array($name, $except) == false)
            {
                $value = (stripos($input, 'value') !== false) ? get_attribute($input, 'value') : '';
                $data[$name] = $value;
            }
        }

        return $data;
    }

    private function eraseCookie()
    {
        File::delete(public_path('cookie.txt'));
    }
}