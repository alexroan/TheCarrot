<?php

namespace App\Data;

use App\Carrot;
use App\Carrots\Utils\EnvironmentCheck;
use App\DiscountCode;
use App\LogImpression;
use App\LogSubscriber;
use Exception;
use Illuminate\Support\Facades\Log;

class CleanupDataAccessor{

    private $environmentCheck;

    public function __construct()
    {
        $this->environmentCheck = app(EnvironmentCheck::class);
    }

    /**
     * Truncate carrots table
     *
     */
    public function truncateCarrots()
    {
        $this->environmentCheck->isDev();

        //Delete carrot records
        Carrot::truncate();
    }

    /**
     * Release all discount codes from being assigned to 
     *
     */
    public function releaseDiscountCodes()
    {
        $this->environmentCheck->isDev();

        DiscountCode::whereNotNull('carrot_id')
            ->update(['carrot_id' => null]);
    }

    /**
     * Truncate log_impressions
     *
     */
    public function truncateLogImpressions()
    {
        $this->environmentCheck->isDev();

        LogImpression::truncate();
    }
    
    /**
     * Truncate log_subscribers
     *
     */
    public function truncateLogSubscribers()
    {
        $this->environmentCheck->isDev();

        LogSubscriber::truncate();
    }

    public function truncateLogAlreadySubscribed()
    {
        //TODO
        Log::info("truncateLogAlreadySubscribed not implemented yet");
    }
}