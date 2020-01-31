<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateAndCompile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carrot:gencomp {id : Carrot id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate HTML and Compile the Carrot in a single command';

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
        $carrotId = (int) $this->argument('id');
        $this->call("carrot:generate", ['id' => $carrotId]);
        $this->call("carrot:compile", ['id' => $carrotId]);
    }
}
