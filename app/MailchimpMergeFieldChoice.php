<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailchimpMergeFieldChoice extends Model
{
    protected $fillable = [
        'mailchimp_merge_field_id',
        'value'
    ];
}
