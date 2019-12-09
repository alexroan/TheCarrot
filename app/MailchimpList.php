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

    public function account()
    {
        return $this->belongsTo(MailchimpAccount::class);
    }

    public function carrot()
    {
        return $this->hasOne(Carrot::class);
    }

    public function mergeFields()
    {
        return $this->hasMany(MailchimpMergeField::class);
    }
}
