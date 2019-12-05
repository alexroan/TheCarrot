<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailchimpMergeFieldsChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_merge_fields_choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mailchimp_merge_field_id')->references('id')->on('mailchimp_merge_fields');
            $table->string('value');
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
        Schema::dropIfExists('mailchimp_merge_fields_choices');
    }
}
