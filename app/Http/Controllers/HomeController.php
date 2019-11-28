<?php

namespace App\Http\Controllers;

use App\MailchimpIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $numberOfIntegrations 
            = MailchimpIntegration::where('user_id', Auth::user()->id)
            ->get()
            ->count();

        return view('home', ['numberOfIntegrations' => $numberOfIntegrations]);
    }
}
