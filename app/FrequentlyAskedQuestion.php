<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrequentlyAskedQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'answer'
    ];
}
