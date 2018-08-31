<?php namespace App\Services;

use App\User;
use Exception;
use File;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use function GuzzleHttp\default_user_agent;
use GuzzleHttp\Exception\RequestException;
use Log;

class HTTPRequestService
{

    public function __construct()
    {

    }

//    public function login($username, $password)
//    {
//        $login_data = $this->extractLoginInformation();
//
//        if((boolean)count($login_data) == false)
//            return false;
//
//        $login_data = array_merge($login_data, ['txtUserName' => $username, 'txtUserPass' => $password]);
//
//        dd($this->sendLoginRequest($login_data));
//    }

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

    private function eraseCookie()
    {
        File::delete(public_path('cookie.txt'));
    }
}