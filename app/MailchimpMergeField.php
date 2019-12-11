<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailchimpMergeField extends Model
{
    protected $fillable = [
        'mailchimp_list_id',
        'name',
        'tag',
        'type'
    ];

    public function choices()
    {
        return $this->hasMany(MailchimpMergeFieldsChoice::class);
    }
}
