<?php

namespace App\Http\Controllers;

use App\MailchimpAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Data\MailchimpDataAccessor;

class HomeController extends Controller
{

    /**
     * Mailchimp data accessor
     *
     * @var App\Data\MailchimpDataAccessor
     */
    private $mailchimpAccessor;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $accounts = $this->mailchimpAccessor->getAccounts(Auth::user()->id);
        $accountsCount = $accounts->count();

        $subsciptionLists = [];
        $subsciptionListsCount = 0;
        foreach ($accounts as $account) {
            
        }
        
        return view('home', [
            'accounts' => $accounts,
            'accountsCount' => $accountsCount,
            'subsciptionLists' => $subsciptionLists,
            'subsciptionListsCount' => $subsciptionListsCount
        ]);
    }
}
