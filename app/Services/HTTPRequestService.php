<?php namespace App\Services;

use Exception;
use File;
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

    public function extractRatingHistory()
    {
        $information = [];
        try{
            $url = config('parsers.platform.domain') . config('parsers.platform.services.history');
            $url_default = config('parsers.platform.services.default');

            $response = http_get($url, $url_default);

            if($response['STATUS']['http_code'] !== 200)
                throw new Exception(get_status_code($response['STATUS']['http_code']), $response['STATUS']['http_code']);

            $dom = $response['FILE'];

            $inputs = parse_array($dom, '<input', '>');
            $data = $this->convertInputToArray($inputs);

            $response = http_post_form($url, $url, $data);
            dd($response['FILE']);

        } catch (Exception $exception){

        }
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