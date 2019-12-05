<?php

namespace App\Http\Controllers;

use App\Data\MailchimpDataAccessor;
use App\External\MailchimpApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscribeController extends Controller
{
    private $mailchimpAccessor;
    private $mailchimpApi;

    /**
     * Create new Subscribe controller
     */
    public function __construct()
    {
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->mailchimpApi = app(MailchimpApi::class);
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

        $email = $parameters['email'];
        $name = $parameters['name'];
        $listId = $parameters['list_id'];

        //Get mailchimp list ID
        $mailchimpList = $this->mailchimpAccessor->getList($listId);
        if(!$mailchimpList) {
            return response()->json("No such list", 400);
        }
        $mailchimpAccount = $mailchimpList->mailchimp_account_id;
        $mailchimpListId = $mailchimpList->list_id;
        //Get url and access token from mailchimp account database
        $mailchimpAccount = $this->mailchimpAccessor->getAccount($mailchimpAccount);
        if(!$mailchimpAccount) {
            return response()->json("Problem retreiving mailchimp account", 400);
        }
        $accessToken = $mailchimpAccount->access_token;
        $url = $mailchimpAccount->url;
        //Get required fields from DB for list -- TODO
        //Subscribe the email address
        try {
            $this->mailchimpApi->subscribe($accessToken, $url, $mailchimpListId, $email, $name);
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
