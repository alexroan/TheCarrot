<?php

namespace App\Console\Commands;

use App\Carrots\Utils\EnvironmentCheck;
use App\Carrots\Utils\Files;
use App\Data\CleanupDataAccessor;
use App\DiscountCode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ClearDevWithoutFreshMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dev:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears dev environment by resetting discount codes, carrots, logs and clearing carrot files';

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
        $environmentCheck = app(EnvironmentCheck::class);
        $cleanupAccessor = app(CleanupDataAccessor::class);
        $files = app(Files::class);

        $environmentCheck->isDev();

        //Delete carrot records
        $cleanupAccessor->truncateCarrots();
        //Remove assigned carrots in the discount codes table
        $cleanupAccessor->releaseDiscountCodes();
        //Delete logs for impressions and subscribed (and already subscribed when that is implemented)
        $cleanupAccessor->truncateLogImpressions();
        $cleanupAccessor->truncateLogSubscribers();
        $cleanupAccessor->truncateLogAlreadySubscribed();
        //Delete carrot files generated
        $files->deleteGeneratedFiles();
    }
}
