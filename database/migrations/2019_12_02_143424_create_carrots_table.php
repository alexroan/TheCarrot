<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mailchimp_list_id')->references('id')->on('mailchimp_lists');
            $table->string('title');
            $table->string('subtitle');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrots');
    }
}
