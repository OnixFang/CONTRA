<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     */
    public function handle()
    {
        $progress = $this->output->createProgressBar(3);

        $progress->setMessage('Estructurando base de datos');
        Artisan::call('migrate:fresh', ['--seed'=>true]);
        $progress->advance();

        $progress->setMessage('Extrayendo datos del Pensum de uapa.edu.do');
        Artisan::call('parser:pensum');
        $progress->advance();

        $progress->setMessage('Llenando la base de datos de Grupos fictisios');
        Artisan::call('db:seed', ['--class'=>'GruposSeeder']);
        $progress->advance();

        $progress->finish();

        $this->line(' ');
        $this->info('Instalación completada');
    }
}
