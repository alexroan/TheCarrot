<?php

namespace App\Data;

use App\Carrot;
use Illuminate\Support\Facades\Log;

class CarrotDataAccessor 
{

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
