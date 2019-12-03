<?php

namespace App\Http\Controllers;

use App\Data\CarrotDataAccessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CarrotController extends Controller
{
    private $carrotAccessor;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->carrotAccessor = app(CarrotDataAccessor::class);
    }

    public function index(Request $request)
    {
        $listId = $request->input('listId');
        return view('carrot', [
            'listId' => $listId
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->input('title-text');
        $subtitle = $request->input('subtitle-text');
        $image = $request->input('keyring-select');
        $listId = $request->input('list-id');

        $this->carrotAccessor
            ->createCarrot($listId, $title, $subtitle, $image);

        return redirect()->to('/home');
    }
}
