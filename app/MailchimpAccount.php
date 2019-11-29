<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailchimpAccount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'mailchimp_user_id',
        'mailchimp_email',
        'access_token', 
        'url'
    ];
}
