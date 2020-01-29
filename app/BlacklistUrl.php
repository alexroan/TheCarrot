<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlacklistUrl extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'carrot_id',
        'url'
    ];
}
