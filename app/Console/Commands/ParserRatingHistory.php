<?php

namespace App\Console\Commands;

use App\Carrera;
use App\Services\HTTPRequestService;
use App\Services\UserService;
use App\User;
use DB;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

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
     * @var Carrera
     */
    private $carrera;

    /**
     * Create a new command instance.
     *
     * @param UserService $user
     * @param HTTPRequestService $HTTPRequestService
     * @param Carrera $carrera
     */
    public function __construct(UserService $user, HTTPRequestService $HTTPRequestService, Carrera $carrera)
    {
        parent::__construct();
        $this->user = $user;
        $this->HTTPRequestService = $HTTPRequestService;
        $this->carrera = $carrera;
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
                throw new Exception("");

            $results = $this->HTTPRequestService->extractRatingHistory();

            $carrera = $this->carrera->where('descripcion', 'like', "%{$results['carrera']}%")->first();
            var_dump($carrera);
            if($carrera !== null)
                $this->user->registerInscription($user, $carrera);

            DB::rollBack();
        } catch (ModelNotFoundException $exception) {
            Log::warning($exception->getMessage());
            $this->warn($exception->getMessage());
            DB::rollBack();
        } catch (Exception $exception) {
            Log::error($exception->getMessage() . $exception->getFile());
            $this->error($exception->getMessage() . $exception->getFile());
            DB::rollBack();
        }
    }
}
