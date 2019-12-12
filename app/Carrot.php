<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailchimp_list_id',
        'title',
        'subtitle',
        'image',
        'carrot_file',
        'archived'
    ];
}
