<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * This controller is to prevent closures from being present in route definitions.
 * When they are present, the route:cache command fails
 */
class ClosureController extends Controller
{
    /**
     * Display index page
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        return view('welcome');
    }

    /**
     * Return request user
     *
     * @param Request $request
     * @return user
     */
    public function apiUser(Request $request)
    {
        return $request->user();
    }
}
