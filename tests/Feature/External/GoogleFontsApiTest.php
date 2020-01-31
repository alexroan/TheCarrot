<?php

use App\External\GoogleFontsApi;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class GoogleFontsApiTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    public function testGetFonts()
    {
        $googleFontsApi = new GoogleFontsApi();
        // Log::info(json_encode($googleFontsApi->getFonts()));
    }
}