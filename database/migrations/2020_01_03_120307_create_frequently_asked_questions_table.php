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
            (object)[
                "question" => "How does Signup Carrot make money offering free products?", 
                "answer" => "Good question! We make our income from our high volume paid account holders, and our free account includes our branding on pop-up so we get a bit of free advertising too."
            ],
            (object)[
                "question" => "How much does the service cost?", 
                "answer" => "We don’t charge you a penny unless your business brings in over 5,000 subscribers per month. So you can dramatically increase your volume of subscribers today with no risk!

                Please see our Pricing section to see paid account benefits."
            ],
            (object)[
                "question" => "How long does delivery take?", 
                "answer" => "Mainland UK based subscribers will receive their free product within 3 days.
                International and Rest of World orders will be received within 14 days."
            ],
            (object)[
                "question" => "Do you deliver Internationally?", 
                "answer" => "We certainly do! Our p&p charge for non-UK orders is £3.35 and the order will be received within 14 days."
            ],
            (object)[
                "question" => "Who handles the customer service on the orders?", 
                "answer" => "We do! Every subscriber who orders a free product receives an email confirmation that includes our Customer Services contact details. If an order does not arrive, needs replacing or refunding we will handle it and you’ll never need to know about it."
            ],
            (object)[
                "question" => "How does the product & packaging look when received?", 
                "answer" => "All parcels are sent unbranded and without marketing material of any kind to ensure the subscriber attributes the value of the product to you."
            ],
            (object)[
                "question" => "Who do you integrate with?", 
                "answer" => "Right now we integrate with Mailchimp only as an email marketing solution however our pop-up service can be integrated into almost any website/online store/blog. We simply provide you with some code to copy and paste into website. If you do not have personal access to your website code simply send to your developer or get in touch with us for advice."
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
