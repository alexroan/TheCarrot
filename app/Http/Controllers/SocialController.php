<?php

namespace App\Http\Controllers;

use App\Integrations\Mailchimp;
use App\MailchimpIntegration;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialController extends Controller
{
    private $mailchimp;

    public function __construct()
    {
        $this->mailchimp = app(Mailchimp::class);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $mailchimpDetails = Socialite::driver($provider)->user();
        $this->subscriberLists($mailchimpDetails);
        // $user = $this->createMailchimpIntegration($mailchimpDetails); 
        // return redirect()->to('/home');
    }

    public function subscriberLists($mailchimpDetails)
    {
        $url = $mailchimpDetails->user['api_endpoint'] . '/3.0';
        $accessToken = $mailchimpDetails->token;
        $lists = $this->mailchimp->getLists($url, $accessToken);
        // TODO - Create new view and pass in the lists
        // return view('callback', )
    }

    function createMailchimpIntegration($mailchimpDetails)
    {
        $user = Auth::user();
        $mailchimpIntegration = MailchimpIntegration::create([
            'user_id' => $user->id,
            'access_token' => $mailchimpDetails->token,
            'url' => $mailchimpDetails->user->api_endpoint . '/3.0'
        ]);
        return $mailchimpIntegration;
    }
}
