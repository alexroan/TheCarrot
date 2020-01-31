<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleFont extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'family',
        'category'
    ];
}
