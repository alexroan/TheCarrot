<?php

namespace App\Data;

use App\LogAlreadySubscriber;
use App\LogImpression;
use App\LogProceedToCheckout;
use App\LogSubscriber;

class LogsDataAccessor
{
    /**
     * Get all stats regarding a carrot
     *
     * @param integer $carrotId
     * @return object stats
     */
    public function getConversionStats(int $carrotId)
    {
        $impressions = LogImpression::where('carrot_id', $carrotId)
            ->count();
        $alreadySubscribers = LogAlreadySubscriber::where('carrot_id', $carrotId)
            ->count();
        $subscribers = LogSubscriber::where('carrot_id', $carrotId)
            ->count();
        return (object) [
            'impressions' => $impressions,
            'alreadySubscribers' => $alreadySubscribers,
            'subscribers' => $subscribers
        ];
    }

    /**
     * Get basic customer carrot stats plus proceed to checkout stats
     *
     * @param integer $carrotId
     * @return object $stats
     */
    public function getAdvancedStats(int $carrotId)
    {
        $stats = $this->getConversionStats($carrotId);

        $stats->proceedToCheckout = LogProceedToCheckout::where('carrot_id', $carrotId)
            ->count();

        return $stats;
    }

    /**
     * Log that a carrot has been displayed
     *
     * @param  integer $carrotId
     * @return int id
     */
    public function logImpression(int $carrotId)
    {
        return LogImpression::create(
            [
            'carrot_id' => $carrotId
            ]
        );
    }

    /**
     * Log that a user has proceeded to the checkout page
     *
     * @param integer $carrotId
     * @return int id
     */
    public function logProceedToCheckout(int $carrotId)
    {
        return LogProceedToCheckout::create(
            [
                'carrot_id' => $carrotId
            ]
        );
    }

    /**
     * Log that a subscriber has subscribed using a carrot
     *
     * @param  int $carrot
     * @return int id
     */
    public function logSubscriber(int $carrotId)
    {
        return LogSubscriber::create(
            [
            'carrot_id' => $carrotId
            ]
        );
    }

    /**
     * Log when a subscriber is already subscribed
     *
     * @param integer $carrotId
     * @return int
     */
    public function logAlreadySubscriber(int $carrotId)
    {
        return LogAlreadySubscriber::create(
            [
            'carrot_id' => $carrotId
            ]
        );
    }
}
