<?php

namespace App\Carrots;

/**
 * Override system function
 *
 * @param object $object
 * @return int 2
 */
function count($object)
{
    return 2;
}

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

    /**
     * Test generate() function
     *
     */
    public function testGenerateCarrotHtml()
    {
        $carrot = (object)[
            'id' => 99,
            'product_id' => 55,
            'title' => 'title',
            'subtitle' => 'subtitle',
            'mailchimp_list_id' => 22
        ];
        $htmlTemplate = "{{product-image}}"
            . "{{product-image-small}}"
            . "{{h1}}"
            . "{{h2}}"
            . "{{subscribe-url}}"
            . "{{carrot-id}}"
            . "{{product-options}}"
            . "{{merge-fields}}"
            . "{{button-style}}";
        $product = (object)[
            'image' => 'image',
            'colour_code' => 'colour_code'
        ];
        $products = (object)[
            (object)['id' => 44, 'image' => 'image44', 'name' => 'name44', 'product_id' => 'product_id44'],
            (object)['id' => 55, 'image' => 'image55', 'name' => 'name55', 'product_id' => 'product_id55'],
            (object)['id' => 66, 'image' => 'image66', 'name' => 'name66', 'product_id' => 'product_id66'],
        ];
        $mergeFields = (object)[
            (object)['name' => 'merge1', 'tag' => 'tag1', 'choices' => (object)[
                (object)['value' => 'choice1'],
                (object)['value' => 'choice2']
            ]],
            (object)['name' => 'merge2', 'tag' => 'tag1', 'choices' => (object)[]]
        ];

        $this->files->shouldReceive('readHtmlTemplate')
            ->once()
            ->andReturn($htmlTemplate);

        $this->productAccessor->shouldReceive('getProduct')
            ->once()
            ->with($carrot->product_id)
            ->andReturn($product);

        $this->productAccessor->shouldReceive('getProducts')
            ->once()
            ->andReturn($products);

        $this->mailchimpAccessor->shouldReceive('getMergeFields')
            ->once()
            ->with($carrot->mailchimp_list_id)
            ->andReturn($mergeFields);

        $this->files->shouldReceive('putHtmlFile')
            ->once()
            ->andReturn(true);

        $generator = new Generator();
        $returned = $generator->generateCarrotHtml($carrot);

        $this->assertTrue($returned);
    }

    /**
     * Test compileCarrotJs
     *
     * @return void
     */
    public function testCompileCarrotJs()
    {
        $carrotId = 1;
        $htmlFile = "file";
        $htmlContent = "content";
        $jsTemplate = "template";

        $this->files->shouldReceive('readFile')
            ->with($htmlFile)
            ->once()
            ->andReturn($htmlContent);

        $this->files->shouldReceive('readJsTemplate')
            ->once()
            ->andReturn($jsTemplate);

        $expected = "var impressionUrl = '"
            . config('app.url')
            . "/api/impression';var fileContent = '$htmlContent';$jsTemplate";

        $this->files->shouldReceive('putCompiledJsFile')
            ->with($carrotId . '.js', $expected)
            ->once()
            ->andReturn(true);

        $generator = new Generator();
        $returned = $generator->compileCarrotJs($carrotId, $htmlFile);

        $this->assertTrue($returned);
    }
}
