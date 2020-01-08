<?php

namespace App\Carrots;

use App\Carrots\Utils\Files;
use App\Carrots\Utils\Formatter;
use App\Data\CarrotDataAccessor;
use App\Data\MailchimpDataAccessor;
use App\Data\ProductDataAccessor;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class GeneratorTest extends TestCase
{

    private $mailchimpAccessor;
    private $productAccessor;
    private $carrotAccessor;
    private $formatter;
    private $files;

    /**
     * Setup
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->mailchimpAccessor = Mockery::mock(MailchimpDataAccessor::class);
        $this->productAccessor = Mockery::mock(ProductDataAccessor::class);
        $this->carrotAccessor = Mockery::mock(CarrotDataAccessor::class);
        $this->formatter = Mockery::mock(Formatter::class);
        $this->files = Mockery::mock(Files::class);

        $this->app->instance(MailchimpDataAccessor::class, $this->mailchimpAccessor);
        $this->app->instance(ProductDataAccessor::class, $this->productAccessor);
        $this->app->instance(CarrotDataAccessor::class, $this->carrotAccessor);
        $this->app->instance(Formatter::class, $this->formatter);
        $this->app->instance(Files::class, $this->files);
    }

    private function carrotData()
    {
        return (object) [
            'mailchimp_list_id' => '1',
            'id' => '2',
            'title' => '3',
            'subtitle' => '4',
            'image' => '5',
            'product_id' => '55'
        ];
    }

    /**
     * Test generate() function
     *
     * @return void
     */
    public function testGenerate()
    {
        $carrot = $this->carrotData();
        $mergeFields = (object)['foo'=>'bar'];
        $formattedMergeFields = 'MERGE';
        $products = (object)[(object)['id' => 55], (object)['id' => 77]];
        $product = (object)['image'=>'IMAGE','colour_code'=>'colour_code'];
        $formattedProducts = 'PRODUCTS';
        $discount = (object)['code'=>'bar'];
        $baseFile = 'BASE';
        $expected = "const TITLE = \"$carrot->title\";
const SUBTITLE = \"$carrot->subtitle\";
const MERGE_FIELDS = $formattedMergeFields;
const SELECTED_KEYRING_ID = $carrot->product_id;
const PRODUCTS = $formattedProducts;
window.carrotId = \"$carrot->id\";
window.discountCode = \"$discount->code\";
const ROOT_URL = '" . env('APP_URL') . "';
            window.impressionUrl = ROOT_URL + '/api/impression';
            window.subscribeUrl = ROOT_URL + '/subscribe';
$baseFile";

        $this->mailchimpAccessor->shouldReceive('getMergeFields')
            ->once()
            ->with($carrot->mailchimp_list_id)
            ->andReturns($mergeFields);

        $this->formatter->shouldReceive('formatMergeFields')
            ->once()
            ->with($mergeFields)
            ->andReturns($formattedMergeFields);

        $this->productAccessor->shouldReceive('getProducts')
            ->once()
            ->andReturns($products);

        $this->formatter->shouldReceive('formatProducts')
            ->once()
            ->with($products)
            ->andReturns($formattedProducts);

        $this->carrotAccessor->shouldReceive('getDiscountCode')
            ->once()
            ->with($carrot->id)
            ->andReturns($discount);

        $this->files->shouldReceive('readBaseFile')
            ->once()
            ->andReturns($baseFile);

        Log::info($expected);

        $this->files->shouldReceive('putNewFile')
            ->once()
            ->with($carrot->id . '.js', $expected)
            ->andReturns('filepath');

        $generator = new Generator();
        $generator->generate($carrot);
    }
}
