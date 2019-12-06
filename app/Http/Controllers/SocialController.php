<?php

namespace App\Http\Controllers;

use App\MailchimpAccount;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialController extends Controller
{
    private $mailchimp;

    public function __construct()
    {
        $this->middleware('auth');
        $this->mailchimp = app(Mailchimp::class);
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        switch ($provider) {
            case 'mailchimp':
                $this->integrateMailchimp();
                break;
            
            default:
                throw new Exception("Unknown provider");
        }
        return redirect()->to('/home');
    }

    private function integrateMailchimp()
    {
        $mailchimpDetails = Socialite::driver('mailchimp')->user();
        Log::info(json_encode($mailchimpDetails));
        $url = $mailchimpDetails->user['api_endpoint'] . '/3.0';
        $mailchimpUserId = $mailchimpDetails->user['user_id'];
        $mailchimpName = $mailchimpDetails->user['login']['login_name'];
        $accessToken = $mailchimpDetails->token;
        $mailchimpEmail = $mailchimpDetails->email;
        $user = Auth::user();
        $created = MailchimpAccount::create([
            'url' => $url,
            'user_id' => $user->id,
            'access_token' => $accessToken,
            'mailchimp_user_id' => $mailchimpUserId,
            'mailchimp_email' => $mailchimpEmail,
            'mailchimp_name' => $mailchimpName
        ]);
        if (!$created) {
            throw new Exception("Couldn't add mailchimp integration");
        }
        return $created;
    }
}
