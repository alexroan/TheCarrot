<?php

namespace App\Data;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDataAccessor
{

    /**
     * Create a user with basic information
     *
     * @param string $name
     * @param string $email
     * @param string $companyName
     * @return User
     */
    public function createBasic(string $name, string $email, string $companyName)
    {
        $password = Hash::make('password', [
            'rounds' => 12
        ]);
        return User::create([
            'name' => $name,
            'email' => $email,
            'companyname' => $companyName,
            'password' =>$password
        ]);
    }

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
