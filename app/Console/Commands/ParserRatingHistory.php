<?php

namespace App\Console\Commands;

use App\Services\HTTPRequestService;
use App\Services\UserService;
use App\User;
use DB;
use Exception;
use Illuminate\Console\Command;

class ParserRatingHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:rating_history {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var UserService
     */
    private $user;
    /**
     * @var HTTPRequestService
     */
    private $HTTPRequestService;

    /**
     * Create a new command instance.
     *
     * @param UserService $user
     * @param HTTPRequestService $HTTPRequestService
     */
    public function __construct(UserService $user, HTTPRequestService $HTTPRequestService)
    {
        parent::__construct();
        $this->user = $user;
        $this->HTTPRequestService = $HTTPRequestService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle()
    {
        DB::beginTransaction();
        try{
            $user = $this->user->getUser($this->argument('user'));

            if($this->user->loginInPlatform(new User([$this->user->username() => $user->username, 'password' => $user->salt])) == false)
                throw new Exception('');

            $this->HTTPRequestService->extractRatingHistory();

//            $this->HTTPRequestService->sendLogoutRequest();

            DB::rollBack();
        } catch (Exception $exception) {

            DB::rollBack();
        }
    }
}
