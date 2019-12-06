<?php

namespace App\Data;

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
        //For each merge field
        foreach ($mergeFields as $field) {
            //If the field doesn't exist in the params, then not valid
            if (!array_key_exists($field->tag, $parameters)){
                return false;
            }
            //Otherwise, if there are choices, check that the parameter has a valid value
            $numberOfChoices = count($field->choices);
            for ($i=0; $i < $numberOfChoices; $i++) { 
                if ($parameters[$field->tag] == $field->choices[$i]->value) {
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