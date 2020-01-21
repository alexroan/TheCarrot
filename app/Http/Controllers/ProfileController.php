<?php

namespace App\Http\Controllers;

use App\Data\UserDataAccessor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    private $userAccessor;

    /**
     * New Profile Controller
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

        $this->userAccessor = app(UserDataAccessor::class);
    }

    /**
     * Index
     *
     * @param Request $request
     * @return view profile
     */
    public function index(Request $request)
    {
        return view(
            'profile',
            [
                'user' => Auth::user()
            ]
        );
    }

    /**
     * Update current user
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $parameters = $request->all();
        $validator = Validator::make(
            $parameters,
            [
                'name' => ['required', 'string', 'max:255'],
                'companyname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'url' => ['nullable', 'url'],
            ]
        );
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()->toJson()));
        }
        $this->userAccessor->update(
            $parameters['name'],
            $parameters['email'],
            $parameters['companyname'],
            $parameters['url']
        );
        return redirect()->to('/home');
    }
}
