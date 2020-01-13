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
use Illuminate\Support\Facades\App;
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
            'colour_code' => 'colour_code',
            'product_id' => 'product_id'
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

        $frequency = 'session';
        if (App::environment('local')) {
            $frequency = 'always';
        }

        $expected = "var displayFrequency = '$frequency';"
            . "var appUrl = '" . config('app.url') . "';"
            . "var impressionUrl = '" . config('app.url') . "/api/impression';"
            . "var fileContent = '$htmlContent';"
            . "$jsTemplate";

        $this->files->shouldReceive('putCompiledJsFile')
            ->with($carrotId . '.js', $expected)
            ->once()
            ->andReturn(true);

        $generator = new Generator();
        $returned = $generator->compileCarrotJs($carrotId, $htmlFile);

        $this->assertTrue($returned);
    }
}
