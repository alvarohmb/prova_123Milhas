<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Swagger extends Command
{
    private $prosseguir;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:swagger';

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
        $this->prosseguir = true;

        $this->executarComando();

        if (!$this->prosseguir)
        {
            $this->error("Não foi possivel prosseguir com a execução!");
            return false;
        }
        $this->info("Arquivo gerado com sucesso!");
        return true;
    }

    private function executarComando()
    {
        if ($this->prosseguir)
        {
            exec("./vendor/bin/openapi --format json --output ./storage/app/public/swagger/swagger.json ./app/swagger/swagger.php ./app/Http");
        }
        return $this;
    }
}