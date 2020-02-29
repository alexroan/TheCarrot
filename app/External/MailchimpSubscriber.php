<?php

namespace App\External;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\External\DustAndThings;
use App\Data\CarrotDataAccessor;
use App\Data\LogsDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\MailchimpDataUtils;
use App\Data\ProductDataAccessor;
use App\External\MailchimpApi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;

class MailchimpSubscriber
{

    private $dustAndThings;
    private $carrotAccessor;
    private $mailchimpAccessor;
    private $mailchimpApi;
    private $mailchimpUtils;
    private $productAccessor;
    private $logsAccessor;

    public function __construct()
    {
        $this->dustAndThings = app(DustAndThings::class);
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpUtils = app(MailchimpDataUtils::class);
        $this->productAccessor = app(ProductDataAccessor::class);
        $this->logsAccessor = app(LogsDataAccessor::class);
    }

    public function trySubscribe($mailchimpList, $parameters)
    {
        $mailchimpAccount = $this->mailchimpAccessor->getAccountById($mailchimpList->mailchimp_account_id);
        Log::info("Accountfound");

        //Ensure required merge fields are there
        $valid = $this->mailchimpUtils->checkGetRequestMergeFields($parameters, $mailchimpList->id);
        if (!$valid) {
            return "Invalid Merge Fields";
        }
        Log::info("Mailchimp fields validated");
        $parameters = $this->mailchimpUtils->convertMergeFieldsToMailchimpFields($parameters);
        //Subscribe the email address
        try {
            Log::info("Trying subscribe");
            $this->mailchimpApi->subscribe(
                $mailchimpAccount->access_token,
                $mailchimpAccount->url,
                $mailchimpList->list_id,
                $parameters
            );
            Log::info("Subscribed, logging to database");
            //Add to our stats
            $this->logsAccessor->logSubscriber($mailchimpList->carrot->id);
            Log::info("Logged");
        } catch (Exception $e) {
            Log::info("somthing went wrong");
            $rawMessage = $e->getMessage();
            Log::info($rawMessage);
            $message = json_decode($rawMessage);
            if (\is_object($message) && \property_exists($message, 'status')){
                if ($message->status == 400 && $message->title == "Member Exists") {
                    Log::info("Member exists, continue anyway...");
                    $this->logsAccessor->logAlreadySubscriber($mailchimpList->carrot->id);
                    return true;
                }
            }
            else{
                Log::info("Mailchimp provided no response");
            }
            // TODO if status 400 && $message->detail == "Your merge fields were invalid."
            // The mailchimp merge_fields configuration has been changed by the partner.
            // Go into $message->errors and store the errors, prompting a queue task to
            // retrieve the latest changes and update the whole system. Likely that subscribers
            // won't be able to subscribe until this is fixed.

            //TODO Handle when email looks fake
            return $message;
        }
        Log::info("Redirecting");
        return true;
    }
}
