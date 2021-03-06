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
        'mailchimp_name',
        'access_token',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
