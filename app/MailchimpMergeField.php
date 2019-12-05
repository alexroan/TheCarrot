<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailchimpMergeField extends Model
{
    protected $fillable = [
        'mailchimp_list_id',
        'tag',
        'type'
    ];

    public function choices()
    {
        return $this->hasMany(MailchimpMergeFieldChoice::class);
    }
}
