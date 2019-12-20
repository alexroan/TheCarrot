<?php

namespace App\Data;

use App\Carrot;
use App\DiscountCode;
use App\LogImpression;
use App\LogSubscriber;
use Exception;

class CarrotDataAccessor
{

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
     * Get Carrot using the list ID
     *
     * @param  integer $listId
     * @return Object Carrot
     */
    public function getCarrotFromList(int $listId)
    {
        return Carrot::where('mailchimp_list_id', $listId)->first();
    }

    /**
     * Get specific carrot
     *
     * @param  integer $carrotId
     * @return Object Carrot
     */
    public function getCarrot(int $carrotId)
    {
        return Carrot::where('id', $carrotId)->first();
    }

    /**
     * Create new carrot
     *
     * @param  integer $listId
     * @param  string  $title
     * @param  string  $subtitle
     * @param  string  $image
     * @return int Id
     */
    public function createCarrot(int $listId, string $title, string $subtitle, int $id)
    {
        return Carrot::create(
            [
            'mailchimp_list_id' => $listId,
            'title' => $title,
            'subtitle' => $subtitle,
            'product_id' => $id
            ]
        );
    }

    /**
     * Assign a discount code to a carrot
     *
     * @param  integer $carrotId
     * @return int ID
     */
    public function assignDiscountCode(int $carrotId)
    {
        $discountRow = DiscountCode::where('carrot_id', null)
            ->orderBy('id', 'ASC')
            ->first();
        if (!$discountRow) {
            throw new Exception('No available Discount Codes');
        }
        return DiscountCode::where('id', $discountRow->id)
            ->update(['carrot_id' => $carrotId]);
    }

    /**
     * Get discount code from the carrot ID
     *
     * @param  integer $carrotId
     * @return object discount code row
     */
    public function getDiscountCode(int $carrotId)
    {
        return DiscountCode::where('carrot_id', $carrotId)
            ->first();
    }

    /**
     * Set carrot file for carrot row
     *
     * @param  integer $carrotId
     * @param  string  $carrotFile
     * @return int id
     */
    public function setCarrotFile(int $carrotId, string $carrotFile)
    {
        return Carrot::whereId($carrotId)
            ->update(['carrot_file' => $carrotFile]);
    }
}
