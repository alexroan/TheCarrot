<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailchimpMergeFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_merge_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mailchimp_list_id')->references('id')->on('mailchimp_lists');
            $table->string('name');
            $table->string('tag');
            $table->string('type');
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
        Schema::dropIfExists('mailchimp_merge_fields');
    }
}
