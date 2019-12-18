<?php

namespace App\Http\Controllers;

use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\MailchimpDataUtils;
use App\External\MailchimpApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    private $carrotAccessor;
    private $mailchimpAccessor;
    private $mailchimpApi;
    private $mailchimpUtils;

    /**
     * Create new Subscribe controller
     */
    public function __construct()
    {
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->mailchimpApi = app(MailchimpApi::class);
        $this->mailchimpUtils = app(MailchimpDataUtils::class);
    }

    /**
     * Log an impression
     *
     * @param  Request $request
     * @return void
     */
    public function impression(Request $request)
    {
        $parameters = $request->all();
        $validator = Validator::make(
            $parameters,
            [
            'carrot_id' => 'required'
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $carrot = $this->carrotAccessor->getCarrot($parameters['carrot_id']);
        if (!$carrot) {
            return response()->json("Carrot doesn't exist", 400);
        }
        $this->carrotAccessor->logImpression($carrot->id);
        return response()->json("", 201);
    }
}
