<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    /**
     * Construct new Contact Controller
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
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
     * Open the contact page
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        return view('contact');
    }
}
