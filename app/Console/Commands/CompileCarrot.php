<?php

namespace App\Console\Commands;

use App\Carrots\Generator;
use App\Data\CarrotDataAccessor;
use Illuminate\Console\Command;

class CompileCarrot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carrot:compile {id : Carrot id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MUST BE SUDO. Compile carrot from its HTML file.';

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
        $carrotAccessor = app(CarrotDataAccessor::class);
        $generator = app(Generator::class);

        $carrotId = (int) $this->argument('id');
        $carrot = $carrotAccessor->getCarrot($carrotId);
        $generator->compileCarrotJs($carrot->id, $carrot->html_file);
    }
}
