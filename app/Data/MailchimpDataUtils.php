<?php

namespace App\Data;

use Illuminate\Support\Facades\Log;

class MailchimpDataUtils {

    private $mailchimpAccessor;

    public function __construct()
    {
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
    }

    /**
     * Checks array of request parameters against merge fields, to ensure that 
     * the required fields needed to subscribe a user are valid
     *
     * @param array $parameters
     * @param integer $listId - The Carrot list ID
     * @return boolean valid
     */
    public function checkRequestAgainstMergeFields(array $parameters, int $listId)
    {
        $mergeFields = $this->mailchimpAccessor->getMergeFields($listId);
        //If there are no merge fields for this list, then validation complete
        if (count($mergeFields) == 0) {
            return true;
        }

        //If the merge_fields parameter was not passed, fail validation
        if (!array_key_exists('merge_fields', $parameters)) {
            return false;
        }
        $mergeParams = $parameters['merge_fields'];
        //For each merge field
        foreach ($mergeFields as $field) {
            //If the field doesn't exist in the params, then not valid
            if (!array_key_exists($field->tag, $mergeParams)){
                return false;
            }
            //Otherwise, if there are choices, check that the parameter has a valid value
            $numberOfChoices = count($field->choices);
            for ($i=0; $i < $numberOfChoices; $i++) { 
                if ($mergeParams[$field->tag] == $field->choices[$i]->value) {
                    break;
                }
                if($i == ($numberOfChoices-1)) {
                    return false;
                }
            }
        }
        return true;
    }
}