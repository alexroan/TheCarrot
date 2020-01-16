<?php

namespace App\Console\Commands;

use App\Data\CarrotDataAccessor;
use App\Data\LogsDataAccessor;
use App\Mail\CarrotStats as MailCarrotStats;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CarrotStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:carrots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve stats for all carrots';

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
        $logsAccessor = app(LogsDataAccessor::class);

        $ids = $carrotAccessor->getCarrotIds();
        if ($ids->count() > 0) {
            foreach ($ids as $id) {
                $id->stats = $logsAccessor->getConversionStats($id->id);
            }

            $to = [
                [
                    'email' => config('mail.from.address'),
                    'name' => 'Signup Carrot'
                ]
            ];
            Mail::to($to)->send(new MailCarrotStats($ids));
        }
    }
}
