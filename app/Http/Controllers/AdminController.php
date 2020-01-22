<?php

namespace App\Http\Controllers;

use App\Data\UserDataAccessor;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private $userAccessor;

    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'isAdmin']);

        $this->userAccessor = app(UserDataAccessor::class);
    }

    /**
     * Index
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        return view('admin');
    }

    /**
     * Register a new user and send reset email notification
     *
     * @param Request $request
     * @return view
     */
    public function create(Request $request)
    {
        $parameters = $request->all();
        $validator = Validator::make(
            $parameters,
            [
                'name' => ['required', 'string', 'max:255'],
                'companyname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]
        );
        $status = false;
        $message = "";
        if ($validator->fails()) {
            $message = json_encode($validator->errors()->toJson());
            Log::info($message);
            return view(
                'admin',
                [
                    'status' => $status,
                    'message' => $message
                ]
            );
        }

        $created = null;
        try {
            $created = $this->userAccessor->createBasic(
                $parameters['name'],
                $parameters['email'],
                $parameters['companyname']
            );
        } catch (QueryException $e) {
            $message = $e->getMessage();
        }

        if ($created) {
            $broker = app(PasswordBroker::class);
            $token = $broker->createToken($created);
            $created->sendPasswordResetNotification($token);
            $message = "User created and password reset email sent";
            $status = true;
        }

        return view(
            'admin',
            [
                'status' => $status,
                'message' => $message
            ]
        );
    }
}
