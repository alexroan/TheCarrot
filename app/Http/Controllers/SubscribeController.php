<?php

namespace App\Http\Controllers;

use App\Data\MailchimpDataAccessor;
use App\Data\MailchimpDataUtils;
use App\External\MailchimpApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{
    private $mailchimpAccessor;
    private $mailchimpApi;
    private $mailchimpUtils;

    /**
     * Create new Subscribe controller
     */
    public function __construct()
    {
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpUtils = app(MailchimpDataUtils::class);
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
            'email' => 'required|email',
            'list_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $email = $parameters['email'];
        $listId = $parameters['list_id'];
        //Get mailchimp list ID
        $mailchimpList = $this->mailchimpAccessor->getList($listId);
        if(!$mailchimpList) {
            return response()->json("No such list", 400);
        }
        //Get url and access token from mailchimp account database
        $mailchimpAccount = $this->mailchimpAccessor->getAccount($mailchimpList->mailchimp_account_id);
        if(!$mailchimpAccount) {
            return response()->json("Problem retreiving mailchimp account", 400);
        }
        //Ensure required merge fields are there
        $valid = $this->mailchimpUtils->checkRequestAgainstMergeFields($parameters, $mailchimpList->id);
        if(!$valid) {
            return response()->json("Invalid params", 400);
        }
        //Subscribe the email address
        try {
            $this->mailchimpApi->subscribe($mailchimpAccount->access_token, $mailchimpAccount->url, 
                $mailchimpList->list_id, $email);
            //Add to our stats -- TODO
        }
        catch(Exception $e) {
            $message = json_decode($e->getMessage());
            if ($message->status == 400 && $message->title == "Member Exists") {
                return response()->json($message->title, 202);
            }
            return response()->json($message, 400);
        }
        return response()->json(true, 200);
    }
}
