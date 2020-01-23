<?php

namespace App\Http\Controllers;

use App\Carrots\Utils\Formatter;
use App\Data\LogsDataAccessor;
use App\MailchimpAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Data\MailchimpDataAccessor;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
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
    private $logsAccessor;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->formatter = app(Formatter::class);
        $this->logsAccessor = app(LogsDataAccessor::class);
    }

    /**
     * Post message content to send to admin
     *
     * @param Request $request
     * @return view
     */
    public function send(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'message' => 'string|required'
        ]);


        $to = [
            [
                'email' => config('mail.from.address'),
                'name' => 'Signup Carrot'
            ]
        ];

        Mail::to($to)->send(new ContactUs($request->input('title'), $request->input('message')));
        return Redirect::to('home')->with('status', 'Message sent to us, thanks!');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account = $this->mailchimpAccessor->getAccountByUserId(Auth::user()->id);
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
                $list->stats = $this->logsAccessor->getConversionStats($list->carrot->id);
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
