<?php namespace App\Services;

use App\Mail\UserRegistered;
use App\User;
use Exception;
use Hash;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Mail;
use Log;

class UserService
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var HTTPRequestService
     */
    private $httpRequestService;

    public function __construct(User $user, HTTPRequestService $httpRequestService)
    {
        $this->user = $user;
        $this->httpRequestService = $httpRequestService;
    }

    public function username()
    {
        return 'username';
    }

    /**
     * @param User $user
     * @return bool
     */
    public function loginInPlatform(User $user)
    {
        $status = false;

        $login_data = $this->httpRequestService->extractLoginInformation();

        if((boolean)count($login_data) == false)
            return $status;

        $login_data = array_merge($login_data, ['txtUserName' => $user->username, 'txtUserPass' => $user->password]);

        $status = $this->httpRequestService->sendLoginRequest($login_data);

        return $status;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user)
    {
        $status = false;
        try{
            $user_finded = $this->user->where($this->username(), $user->username)->where('password', Hash::make($user->password))->first();

            if($user_finded == null)
                $user = $this->user->create([
                    $this->username() => $user->username, 'password' => Hash::make($user->password),
                    'salt' => encrypt($user->password), 'activate_code' => substr(encrypt(config('app.key')), 0, 280)
                ]);

            if($user_finded instanceof User)
                $user_finded->update(['password' => Hash::make($user->password), 'salt' => encrypt($user->password)]);

            $status = true;
        }catch (Exception $exception){
            Log::error($exception->getMessage() . ' ' . $exception->getFile() . ' ' . $exception->getLine(), $exception->getTrace());
            $status = false;
        }
        return $status;
    }
}