<?php

namespace App\Data;

use App\BlacklistUrl;
use App\Carrot;
use App\DiscountCode;
use Exception;

class CarrotDataAccessor
{

    /**
     * Set blacklist urls for a specific carrot
     *
     * @param integer $carrotId
     * @param array $urls
     * @return void
     */
    public function setBlacklistUrls(int $carrotId, array $urls)
    {
        foreach ($urls as $url) {
            BlacklistUrl::create([
                'carrot_id' => $carrotId,
                'url' => trim($url)
            ]);
        }
    }

    /**
     * Delete blacklisted urls for a specific carrot
     *
     * @param integer $carrotId
     * @return success
     */
    public function deleteBlacklistedUrls(int $carrotId)
    {
        return BlacklistUrl::where('carrot_id', $carrotId)
            ->delete();
    }

    /**
     * Get all carrot ids
     *
     * @return void
     */
    public function getCarrotIds()
    {
        return Carrot::where('id', '>', '0')->get('id');
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
     * Update carrot
     *
     * @param integer $id
     * @param string $title
     * @param string $subtitle
     * @param integer $productId
     * @return int id
     */
    public function updateCarrot(int $id, string $title, string $subtitle, int $productId)
    {
        return Carrot::whereId($id)
            ->update([
                'title' => $title,
                'subtitle' => $subtitle,
                'product_id' => $productId
            ]);
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
     * Get count of unassigned discount codes
     *
     * @return int number of unassigned discount codes
     */
    public function getUnassignedDiscountCodesCount()
    {
        return DiscountCode::where('carrot_id', null)
            ->orderBy('id', 'ASC')
            ->count();
    }

    public function setHtmlFile(int $carrotId, string $htmlFile)
    {
        return Carrot::whereId($carrotId)
            ->update(['html_file' => $htmlFile]);
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
