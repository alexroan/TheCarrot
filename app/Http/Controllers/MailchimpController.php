<?php

namespace App\Http\Controllers;

use App\Data\MailchimpDataAccessor;
use App\External\MailchimpApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MailchimpController extends Controller
{
    private $mailchimpApi;
    private $mailchimpAccessor;

    public function __construct()
    {
        $this->middleware('auth');
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
    }

    public function select(Request $request)
    {
        $account = Session::get('mailchimpAccount');
        $accountId = $account->id;
        $listId = $request->input('list-select');
        foreach (Session::get('subscriptionLists') as $list) {
            if ($list->id == $listId) {
                $this->mailchimpAccessor->createList(
                    $accountId,
                    $listId,
                    $list->name
                );
                break;
            }
        }
        return redirect()->to('/home');
    }

    public function lists()
    {
        $mailchimpAccount = Session::get('mailchimpAccount');
        $response = $this->mailchimpApi->getLists(
            $mailchimpAccount->access_token,
            $mailchimpAccount->url
        );

        $subscriptionLists = $response->lists;
        Session::put('subscriptionLists', $subscriptionLists);

        return view('mailchimp', [
            'lists' => $subscriptionLists
        ]);
    }
}
