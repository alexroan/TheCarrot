<?php

namespace App\Data;

use App\MailchimpAccount;
use App\MailchimpList;
use App\MailchimpMergeField;
use App\MailchimpMergeFieldsChoice;
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
     * Get single list from ID
     *
     * @param integer $listId - The Carrot list ID
     * @return Object table row
     */
    public function getList(int $listId)
    {
        return MailchimpList::whereId($listId)->first();
    }

    /**
     * Create a new list
     *
     * @param integer $mailchimpAccountId
     * @param string $listId - Mailchimp list ID
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

    /**
     * Get merge fields for list
     *
     * @param integer $listId - The Carrot list ID
     * @return array row objects
     */
    public function getMergeFields(int $listId)
    {
        return MailchimpMergeField::where('mailchimp_list_id', $listId)->get();
    }

    /**
     * Store merge fields for list
     *
     * @param integer $listId - The Carrot list ID
     * @param array $mergeFields
     * @return boolean
     */
    public function storeMergeFields(int $listId, array $mergeFields)
    {
        foreach ($mergeFields as $field) {
            if ($field->required) {
                $mergeFieldRow = MailchimpMergeField::create([
                    'mailchimp_list_id' => $listId,
                    'tag' => $field->tag,
                    'type' => $field->type
                ]);
                $options = $field->options;
                if (\property_exists($options, 'choices')) {
                    foreach ($options->choices as $choice) {
                        MailchimpMergeFieldsChoice::create([
                            'mailchimp_merge_field_id' => $mergeFieldRow->id,
                            'value' => $choice
                        ]);
                    }
                }
            }
        }
        return true;
    }
}