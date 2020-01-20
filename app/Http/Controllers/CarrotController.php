<?php

namespace App\Http\Controllers;

use App\Carrots\Generator;
use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\ProductDataAccessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarrotController extends Controller
{
    private $carrotAccessor;
    private $productAccessor;
    private $mailchimpAccessor;
    private $carrotGenerator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->productAccessor = app(ProductDataAccessor::class);
        $this->mailchimpAccessor = app(MailchimpDataAccessor::class);
        $this->carrotGenerator = app(Generator::class);
    }

    /**
     * Display page
     *
     * @param  Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $listId = $request->input('listId');
        $products = $this->productAccessor->getProductsInStock();
        $list = $this->mailchimpAccessor->getList($listId);
        $carrotTitle = "";
        $carrotSubtitle = "";
        if ($list->carrot) {
            $carrotTitle = $list->carrot->title;
            $carrotSubtitle = $list->carrot->subtitle;
        }
        return view(
            'carrot',
            [
            'listId' => $listId,
            'products' => $products,
            'carrotTitle' => $carrotTitle,
            'carrotSubtitle' => $carrotSubtitle
            ]
        );
    }

    /**
     * Create a new carrot using information from the form
     *
     * @param  Request $request
     * @return redirect
     */
    public function create(Request $request)
    {
        $title = addslashes($request->input('title-text'));
        $subtitle = addslashes($request->input('subtitle-text'));
        $productId = (int)$request->input('keyring-select');
        $listId = $request->input('list-id');

        $list = $this->mailchimpAccessor->getList($listId);
        if (!$list->carrot) {
            $carrot = $this->carrotAccessor
                ->createCarrot($listId, $title, $subtitle, $productId);
            $this->carrotAccessor->assignDiscountCode($carrot->id);
        } else {
            $carrot = $list->carrot;
            $this->carrotAccessor->updateCarrot($carrot->id, $title, $subtitle, $productId);
        }

        $htmlFile = $this->carrotGenerator->generateCarrotHtml($carrot);
        $this->carrotAccessor->setHtmlFile($carrot->id, $htmlFile);

        $carrotFile = $this->carrotGenerator->compileCarrotJs($carrot->id, $htmlFile);
        $this->carrotAccessor->setCarrotFile($carrot->id, $carrotFile);

        return redirect()->to('/home');
    }
}
