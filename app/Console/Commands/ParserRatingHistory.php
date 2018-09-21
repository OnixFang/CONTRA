<?php

namespace App\Console\Commands;

use App\Carrera;
use App\InscripcionCiclo;
use App\Services\HTTPRequestService;
use App\Services\InscripcionCicloService;
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
    private $career;
    /**
     * @var InscripcionCiclo
     */
    private $inscripcionCiclo;

    /**
     * Create a new command instance.
     *
     * @param InscripcionCicloService $inscripcionCicloService
     * @param UserService $user
     * @param HTTPRequestService $HTTPRequestService
     * @param Carrera $career
     */
    public function __construct(InscripcionCicloService $inscripcionCicloService, UserService $user, HTTPRequestService $HTTPRequestService, Carrera $career)
    {
        parent::__construct();
        $this->user = $user;
        $this->career = $career;
        $this->HTTPRequestService = $HTTPRequestService;
        $this->inscripcionCicloService = $inscripcionCicloService;
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

            $career = $this->career->where('descripcion', 'like', "%{$results->get('career')}%")->first();
            if($career !== null)
                $this->user->registerInscription($user, $career);

            $results->get('cycles')->each(function ($cycle) use($user) {
                $this->inscripcionCicloService->register($user, $cycle['key'], $cycle['subjects']);
            });

            DB::commit();
        } catch (ModelNotFoundException $exception) {
            Log::warning($exception->getMessage() . $exception->getFile());
            $this->warn($exception->getMessage() . $exception->getFile());
            DB::rollBack();
        } catch (Exception $exception) {
            Log::error($exception->getMessage() . $exception->getFile());
            $this->error($exception->getMessage() . $exception->getFile());
            DB::rollBack();
        }
    }
}
