<?php

namespace App\Data;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserDataAccessor
{
    /**
     * Update user
     *
     * @param string $name
     * @param string $email
     * @param string $companyName
     * @param string $url
     * @return int id
     */
    public function update(string $name, string $email, string $companyName, string $url = null)
    {
        return User::whereId(Auth::user()->id)
            ->update([
                'name' => $name,
                'email' => $email,
                'companyname' => $companyName,
                'url' => $url
            ]);
    }
}
