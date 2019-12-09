<?php

namespace App\Http\Controllers;

use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\MailchimpDataUtils;
use App\External\MailchimpApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    private $carrotAccessor;
    private $mailchimpAccessor;
    private $mailchimpApi;
    private $mailchimpUtils;

    /**
     * Create new Subscribe controller
     */
    public function __construct()
    {
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpUtils = app(MailchimpDataUtils::class);
    }

    /**
     * Log an impression
     *
     * @param Request $request
     * @return void
     */
    public function impression(Request $request)
    {
        $parameters = $request->all();
        $validator = Validator::make($parameters, [
            'carrot_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $carrot = $this->carrotAccessor->getCarrot($parameters['carrot_id']);
        if(!$carrot) {
            return response()->json("Carrot doesn't exist", 400);
        }
        $this->carrotAccessor->logImpression($carrot->id);
        return response()->json("", 201);
    }

    /**
     * Subscribe a new user
     *
     * @param Request $request
     * @return json response
     */
    public function subscribe(Request $request)
    {
        $parameters = $request->all();
        $validator = Validator::make($parameters, [
            'email_address' => 'required|email',
            'carrot_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $carrot = $this->carrotAccessor->getCarrot($parameters['carrot_id']);
        if(!$carrot) {
            return response()->json("Carrot doesn't exist", 400);
        }
        $mailchimpList = $this->mailchimpAccessor->getList($carrot->mailchimp_list_id);
        $mailchimpAccount = $this->mailchimpAccessor->getAccount($mailchimpList->mailchimp_account_id);

        //Ensure required merge fields are there
        $valid = $this->mailchimpUtils->checkRequestAgainstMergeFields($parameters, $mailchimpList->id);
        if(!$valid) {
            return response()->json("Invalid params", 400);
        }
        //Subscribe the email address
        try {
            $this->mailchimpApi->subscribe($mailchimpAccount->access_token, $mailchimpAccount->url, 
                $mailchimpList->list_id, $parameters);
            //Add to our stats
            $this->carrotAccessor->logSubscriber($carrot->id);
        }
        catch(Exception $e) {
            $message = json_decode($e->getMessage());
            if ($message->status == 400 && $message->title == "Member Exists") {
                return response()->json($message->title, 202);
            }
            // TODO if status 400 && $message->detail == "Your merge fields were invalid."
            // The mailchimp merge_fields configuration has been changed by the partner.
            // Go into $message->errors and store the errors, prompting a queue task to 
            // retrieve the latest changes and update the whole system. Likely that subscribers
            // won't be able to subscribe until this is fixed.
            return response()->json($message, 400);
        }
        return response()->json("", 200);
    }
}
