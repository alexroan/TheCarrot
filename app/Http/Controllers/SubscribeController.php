<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\External\DustAndThings;
use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\MailchimpDataUtils;
use App\External\MailchimpApi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;

class SubscribeController extends Controller
{
    private $dustAndThings;
    private $carrotAccessor;
    private $mailchimpAccessor;
    private $mailchimpApi;
    private $mailchimpUtils;

    public function __construct()
    {
        $this->dustAndThings = app(DustAndThings::class);
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpUtils = app(MailchimpDataUtils::class);
    }

    public function testSubscribe(Request $request)
    {
        Log::info(json_encode($request->all()));
        return Redirect::to("https://google.com");
    }

    /**
     * Subscribe
     *
     * @param  Request $request
     * @return return redirect
     */
    public function subscribe(Request $request)
    {
        Log::info("Validating");
        $parameters = $request->all();
        $validator = Validator::make(
            $parameters, [
            'email_address' => 'required|email',
            'carrot_id' => 'required|integer',
            'product_id' => 'required',
            'product_text' => 'required'
            ]
        );
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()->toJson()));
        }
        Log::info("Validated inputs");

        $carrot = $this->carrotAccessor->getCarrot($parameters['carrot_id']);
        if(!$carrot) {
            throw new Exception("Carrot doesn't exist");
        }
        Log::info("Carrot found");
        $mailchimpList = $this->mailchimpAccessor->getList($carrot->mailchimp_list_id);
        $mailchimpAccount = $this->mailchimpAccessor->getAccount($mailchimpList->mailchimp_account_id);
        $discountCode = $carrot->discountCode->code;
        Log::info("List, Account and Discount code found");

        //Ensure required merge fields are there
        $valid = $this->mailchimpUtils->checkGetRequestMergeFields($parameters, $mailchimpList->id);
        if(!$valid) {
            throw new Exception("Invalid merge fields");
        }
        Log::info("Mailchimp fields validated");
        //Subscribe the email address
        try {
            Log::info("Trying subscribe");
            $this->mailchimpApi->subscribe(
                $mailchimpAccount->access_token, $mailchimpAccount->url, 
                $mailchimpList->list_id, $parameters
            );
            Log::info("Subscribed, logging to database");
            //Add to our stats
            $this->carrotAccessor->logSubscriber($carrot->id);
            Log::info("Logged");
        }
        catch(Exception $e) {
            $message = json_decode($e->getMessage());
            if ($message->status == 400 && $message->title == "Member Exists") {
                Log::info("Member exists, continue anyway...");
                return $this->dustAndThings->redirect($parameters, $discountCode);
            }
            // TODO if status 400 && $message->detail == "Your merge fields were invalid."
            // The mailchimp merge_fields configuration has been changed by the partner.
            // Go into $message->errors and store the errors, prompting a queue task to 
            // retrieve the latest changes and update the whole system. Likely that subscribers
            // won't be able to subscribe until this is fixed.
            throw new Exception($message);
        }
        Log::info("Redirecting");
        return $this->dustAndThings->redirect($parameters, $discountCode);
    }
}
