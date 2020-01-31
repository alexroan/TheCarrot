<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\External\GoogleFontsApi;
use App\GoogleFont;

class CreateGoogleFontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('google_fonts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('family')->unique();
            $table->string('category');
            $table->timestamps();
        });

        $googleFontsApi = app(GoogleFontsApi::class);
        $response = $googleFontsApi->getFonts();
        foreach ($response->items as $font) {
            GoogleFont::create([
                'family' => $font->family,
                'category' => $font->category
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('google_fonts');
    }
}
