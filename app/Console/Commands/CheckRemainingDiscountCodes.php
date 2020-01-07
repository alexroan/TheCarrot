<?php

namespace App\Console\Commands;

use App\Data\CarrotDataAccessor;
use App\Mail\LowDiscountCodes;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckRemainingDiscountCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health:discounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check how many discount codes are left available to be assigned';

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

        $number = $carrotAccessor->getUnassignedDiscountCodesCount();
        if ($number <= 50) {
            $to = [
                [
                    'email' => \getenv('MAIL_FROM_ADDRESS'),
                    'name' => 'Signup Carrot',
                ]
            ];
            Mail::to($to)->send(new LowDiscountCodes($number));
        }
    }
}
