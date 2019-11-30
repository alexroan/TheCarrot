<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailchimpList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailchimp_account_id',
        'list_name',
        'list_id'
    ];
}
