<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailchimpAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailchimp_accounts', function (Blueprint $table) {
            $table->bigInteger('user_id')->references('id')->on('users');
            $table->bigInteger('mailchimp_user_id');
            $table->string('access_token');
            $table->string('url');
            $table->timestamps();

            $table->unique(['user_id', 'mailchimp_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailchimp_accounts');
    }
}
