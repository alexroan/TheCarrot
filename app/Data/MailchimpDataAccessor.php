<?php

namespace App\Data;

use App\MailchimpAccount;
use Illuminate\Support\Facades\Log;

class MailchimpDataAccessor 
{

    public function getAccounts(int $userId)
    {
        return MailchimpAccount::where('user_id', $userId)->get();
    }
}