<?php

namespace App\Data;

use App\MailchimpAccount;
use App\MailchimpList;
use Illuminate\Support\Facades\Log;

class MailchimpDataAccessor 
{

    /**
     * Get mailchimp account associated with user
     *
     * @param integer $userId
     * @return Object table row
     */
    public function getAccount(int $userId)
    {
        return MailchimpAccount::where('user_id', $userId)->first();
    }

    /**
     * Get lists associated with account
     *
     * @param integer $accountId
     * @return Array rows
     * 
     */
    public function getLists(int $accountId)
    {
        return MailchimpList::where('mailchimp_account_id', $accountId)->get();
    }

    /**
     * Create a new list
     *
     * @param integer $mailchimpAccountId
     * @param string $listId
     * @param string $listName
     * @return int id
     */
    public function createList(int $mailchimpAccountId, string $listId, string $listName)
    {
        return MailchimpList::create([
            'mailchimp_account_id' => $mailchimpAccountId,
            'list_id' => $listId,
            'list_name' => $listName
        ]);
    }
}