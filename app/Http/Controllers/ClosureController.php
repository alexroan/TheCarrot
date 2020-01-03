<?php

namespace App\Http\Controllers;

use App\Data\FrequentlyAskedQuestionsDataAccessor;
use Illuminate\Http\Request;

/**
 * This controller is to prevent closures from being present in route definitions.
 * When they are present, the route:cache command fails
 */
class ClosureController extends Controller
{
    private $faqAccessor;

    public function __construct()
    {
        $this->faqAccessor = app(FrequentlyAskedQuestionsDataAccessor::class);
    }

    /**
     * Display index page
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $faqs = $this->faqAccessor->getAll();
        return view(
            'welcome',
            [
            'faqs' => $faqs
            ]
        );
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
