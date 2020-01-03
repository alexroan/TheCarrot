<?php

use App\FrequentlyAskedQuestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequentlyAskedQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequently_asked_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('question');
            $table->text('answer');
            $table->timestamps();
        });

        $faqs = [
            (object)[
                "question" => "How is a Signup Carrot different to any other email popup?", 
                "answer" => "Offering something for free in return for an email signup is a tried and tested method for building your email list and making reliable future revenue. Most websites will offer things like:
                    <ul>
                        <li>10% off your first purchase</li>
                        <li>A FREE e-book</li>
                        <li>Be the first to know about new products</li>
                    </ul>
                    We've taken that concept and created an offer that not only massively increases your volume of subscribers but also gives your subscribers a tangible, high quality product of real value which they can hold in their hands."
            ],
        ];

        foreach ($faqs as $faq) {
            FrequentlyAskedQuestion::create([
                'question' => $faq->question,
                'answer' => $faq->answer
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
        Schema::dropIfExists('frequently_asked_questions');
    }
}
