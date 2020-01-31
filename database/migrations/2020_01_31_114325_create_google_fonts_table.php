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

        Schema::table('carrots', function(Blueprint $table){
            $table->bigInteger('google_font_id')->after('mailchimp_list_id')->references('id')->on('google_fonts')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carrots', function(Blueprint $table){
            $table->dropColumn('google_font_id');
        });
        Schema::dropIfExists('google_fonts');
        
    }
}
