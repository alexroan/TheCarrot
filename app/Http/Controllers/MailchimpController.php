<?php

namespace App\Http\Controllers;

use App\Data\MailchimpDataAccessor;
use App\External\MailchimpApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MailchimpController extends Controller
{
    /**
     * Mailchimp API
     *
     * @var App\External\MailchimpApi
     */
    private $mailchimpApi;
    /**
     * Mailchimp data accessor
     *
     * @var App\Data\MailchimpDataAccessor
     */
    private $mailchimpAccessor;

    /**
     * Create new mailchimp controller
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
    }

    /**
     * Select a subscription list
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function select(Request $request)
    {
        $account = Session::get('mailchimpAccount');
        $accountId = $account->id;
        $listId = $request->input('list-select');
        foreach (Session::get('subscriptionLists') as $list) {
            if ($list->id == $listId) {
                $created = $this->mailchimpAccessor->createList(
                    $accountId,
                    $listId,
                    $list->name
                );
                if (!$created) {
                    throw new Exception("Could not insert list");
                }
                $mergeFields = $this->mailchimpApi->getMergeFields($account->access_token, $account->url, $listId);
                $stored = $this->mailchimpAccessor->storeMergeFields($created->id, $mergeFields->merge_fields);
                if (!$stored) {
                    throw new Exception("Could not store merge fields");
                }
                break;
            }
        }
        return redirect()->to('/home');
    }

    /**
     * Get lists
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function lists()
    {
        $mailchimpAccount = Session::get('mailchimpAccount');
        $response = $this->mailchimpApi->getLists(
            $mailchimpAccount->access_token,
            $mailchimpAccount->url
        );

        $subscriptionLists = $response->lists;
        Session::put('subscriptionLists', $subscriptionLists);

        return view(
            'mailchimp', [
            'lists' => $subscriptionLists
            ]
        );
    }
}
