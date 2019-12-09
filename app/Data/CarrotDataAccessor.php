<?php

namespace App\Data;

use App\Carrot;
use App\LogSubscriber;
use Illuminate\Support\Facades\Log;

class CarrotDataAccessor 
{

    /**
     * Log that a subscriber has subscribed using a carrot
     *
     * @param int $carrot
     * @return int id
     */
    public function LogSubscriber(int $carrotId)
    {
        return LogSubscriber::create([
            'carrot_id' => $carrotId
        ]);
    }

    /**
     * Get Carrot using the list ID
     *
     * @param integer $listId
     * @return Object Carrot
     */
    public function getCarrotFromList(int $listId)
    {
        return Carrot::where('mailchimp_list_id', $listId)->first();
    }

    /**
     * Get specific carrot
     *
     * @param integer $carrotId
     * @return Object Carrot
     */
    public function getCarrot(int $carrotId)
    {
        return Carrot::where('id', $carrotId)->first();
    }

    /**
     * Create new carrot
     *
     * @param integer $listId
     * @param string $title
     * @param string $subtitle
     * @param string $image
     * @return int Id
     */
    public function createCarrot(int $listId, string $title, string $subtitle, string $image)
    {
        return Carrot::create([
            'mailchimp_list_id' => $listId,
            'title' => $title,
            'subtitle' => $subtitle,
            'image' => $image
        ]);
    }
}
