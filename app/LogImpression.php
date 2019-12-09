<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogImpression extends Model
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
