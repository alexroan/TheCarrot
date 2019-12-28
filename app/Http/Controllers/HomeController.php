<?php

namespace App\Http\Controllers;

use App\Carrots\Utils\Formatter;
use App\MailchimpAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Data\MailchimpDataAccessor;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Mailchimp data accessor
     *
     * @var App\Data\MailchimpDataAccessor
     */
    private $mailchimpAccessor;
    private $formatter;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->formatter = app(Formatter::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account = $this->mailchimpAccessor->getAccount(Auth::user()->id);
        $accountName = null;
        $subscriptionLists = [];
        if ($account) {
            $accountName = $account->mailchimp_name;
            $subscriptionLists = $this->mailchimpAccessor->getLists($account->id);
            Session::put('mailchimpAccount', $account);
        }
        foreach ($subscriptionLists as $list) {
            if ($list->carrot) {
                $list->carrot->carrot_file = $this->formatter->formatUrl($list->carrot->carrot_file);
            }
        }

        return view(
            'home',
            [
            'accountName' => $accountName,
            'lists' => $subscriptionLists,
            ]
        );
    }
}
