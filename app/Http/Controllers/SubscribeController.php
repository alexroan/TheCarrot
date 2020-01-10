<?php

namespace App\Http\Controllers;

use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Data\ProductDataAccessor;
use App\External\DustAndThings;
use App\External\MailchimpSubscriber;
use Illuminate\Support\Facades\Validator;
use Exception;

class SubscribeController extends Controller
{
    private $productAccessor;
    private $mailchimpSubscriber;
    private $mailchimpAccessor;
    private $carrotAccessor;
    private $dustAndThings;

    public function __construct()
    {
        $this->productAccessor = app(ProductDataAccessor::class);
        $this->mailchimpSubscriber = app(MailchimpSubscriber::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->dustAndThings = app(DustAndThings::class);
    }

    //TODO log that a user has proceeded to checkout
    public function confirm(Request $request)
    {
        Log::info('start');
        $parameters = $request->all();
        $validator = Validator::make(
            $parameters,
            [
                'signupcarrot-email' => 'required|email',
                'signupcarrot-id' => 'required|integer',
                'name-on-product' => 'required|string|max:12',
                'product-select' => 'required'
            ]
        );
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()->toJson()));
        }

        Log::info("validation done");
        $discountCode = $this->carrotAccessor->getDiscountCode($parameters['signupcarrot-id']);
        Log::info('redirecting');
        return $this->dustAndThings->redirect($parameters, $discountCode->code);
    }

    public function subscribe(Request $request)
    {
        $parameters = $request->all();
        $validator = Validator::make(
            $parameters,
            [
            'signupcarrot-email' => 'required|email',
            'signupcarrot-id' => 'required|integer'
            ]
        );
        if ($validator->fails()) {
            throw new Exception(json_encode($validator->errors()->toJson()));
        }

        $carrot = $this->carrotAccessor->getCarrot($parameters['signupcarrot-id']);
        $list = $this->mailchimpAccessor->getList($carrot->mailchimp_list_id);
        $subscribed = $this->mailchimpSubscriber->trySubscribe($list, $parameters);

        if ($subscribed !== true) {
            throw new Exception($subscribed);
        }

        $products = $this->productAccessor->getProducts();
        $product = $products->first();
        if (array_key_exists('signupcarrot-product-select', $parameters)) {
            $product = $this->productAccessor->getProductByProductId($parameters['signupcarrot-product-select']);
        }
        $nameOnProduct = "";
        if (array_key_exists('signupcarrot-engraving', $parameters)) {
            $nameOnProduct = $parameters['signupcarrot-engraving'];
        }
        Log::info(json_encode($product));
        return view(
            'subscribe',
            [
                'carrotId' => $carrot->id,
                'email' => $parameters['signupcarrot-email'],
                'products' => $products,
                'selectedProduct' => $product,
                'nameOnProduct' => $nameOnProduct
            ]
        );
    }
}
