<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogProceedToCheckout extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'carrot_id'
    ];
}
