<?php

namespace App\Http\Controllers;

use App\MailchimpIntegration;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createMailchimpIntegration($getInfo); 
        return redirect()->to('/home');
    }

    function createMailchimpIntegration($getInfo)
    {
        $user = Auth::user();
        $mailchimpIntegration = MailchimpIntegration::create([
            'user_id' => $user->id,
            'access_token' => $getInfo->token
        ]);
        return $mailchimpIntegration;
    }
}
