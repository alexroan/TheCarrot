<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToCarrotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carrots', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->bigInteger('product_id')->after('carrot_file')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carrots', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->string('image');
        });
    }
}
