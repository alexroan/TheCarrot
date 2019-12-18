<?php

namespace App\Http\Controllers;

use App\Carrots\Generator;
use App\Data\CarrotDataAccessor;
use App\Data\ProductDataAccessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarrotController extends Controller
{
    private $carrotAccessor;
    private $productAccessor;
    private $carrotGenerator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->carrotAccessor = app(CarrotDataAccessor::class);
        $this->productAccessor = app(ProductDataAccessor::class);
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
        $products = $this->productAccessor->getProducts();
        return view(
            'carrot',
            [
            'listId' => $listId,
            'products' => $products
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
        $title = $request->input('title-text');
        $subtitle = $request->input('subtitle-text');
        $image = $request->input('keyring-select');
        $listId = $request->input('list-id');

        $carrot = $this->carrotAccessor
            ->createCarrot($listId, $title, $subtitle, $image);
        $this->carrotAccessor->assignDiscountCode($carrot->id);

        $carrotFile = $this->carrotGenerator->generate($carrot);
        $this->carrotAccessor->setCarrotFile($carrot->id, $carrotFile);

        return redirect()->to('/home');
    }
}
