<?php

namespace App\Data;

use Illuminate\Support\Facades\Log;

class MailchimpDataUtils
{

    private $mailchimpAccessor;

    public function __construct()
    {
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
    }

    /**
     * Check get request against stored merge fields
     *
     * @param  array   $parameters
     * @param  integer $listId
     * @return boolean
     */
    public function checkGetRequestMergeFields(array $parameters, int $listId)
    {
        $mergeFields = $this->mailchimpAccessor->getMergeFields($listId);
        //If there are no merge fields for this list, then validation complete
        if (count($mergeFields) == 0) {
            return true;
        }
        foreach ($mergeFields as $field) {
            $parameterName = $this->parameterExists($field, $parameters);
            if (!$parameterName) {
                return false;
            }
            $numberOfChoices = count($field->choices);
            for ($i=0; $i < $numberOfChoices; $i++) {
                if ($parameters[$parameterName] == $field->choices[$i]->value) {
                    break;
                }
                if ($i == ($numberOfChoices-1)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Parameter exists in array
     *
     * @param  int   $field
     * @param  array $parameters
     * @return mixed False or parameter name
     */
    private function parameterExists($field, $parameters)
    {
        foreach ($parameters as $key => $value) {
            $parameterSplit = explode("||", $key);
            if (count($parameterSplit) > 1 && $parameterSplit[1] == $field->tag) {
                return $key;
            }
        }
        return false;
    }
}
