<?php

namespace App\Http\Controllers;

use App\MailchimpAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $mailchimpAccounts 
            = MailchimpAccount::where('user_id', Auth::user()->id)
            ->get();

        Log::info(json_encode($mailchimpAccounts));

        $mailchimpAccountsCount = $mailchimpAccounts->count();
        
        return view('home', [
            'mailchimpAccounts' => $mailchimpAccounts,
            'mailchimpAccountsCount' => $mailchimpAccountsCount
        ]);
    }
}
