<?php

namespace App\Carrots\Utils;

/**
 * Override system variable
 *
 * @param string $accessor
 * @return string
 */
function config(string $accessor)
{
    return $accessor;
}

use App\Carrots\Utils\Formatter;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class FormatterTest extends TestCase
{
    private $formatter;

    /**
     * Setup
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->formatter = new Formatter();
    }

    /**
     * Test format url
     *
     */
    public function testFormatUrl()
    {
        $generatedPath = "/popups/carrots/generated/123.js";
        $url = "anything/which/could/possibly/go/here".$generatedPath;

        $formatted = $this->formatter->formatUrl($url);
        $expected = 'app.url' . $generatedPath;
        $this->assertEquals($expected, $formatted);
    }

    /**
     * Test formatMergeFields
     *
     * @return void
     */
    public function testFormatMergeFields()
    {
        $data = $this->mergeFieldsData();
        $formatted = $this->formatter->formatMergeFields($data->input);
        $this->assertEquals($data->output, $formatted);
    }

    /**
     * Test formatProducts
     *
     * @return void
     */
    public function testFormatProducts()
    {
        $data = $this->productsData();
        $formatted = $this->formatter->formatProducts($data->input);
        $this->assertEquals($data->output, $formatted);
    }

    public function testGetProductUsingId()
    {
        $inputData = (object)[
            0 => (object) [
                'id' => 0,
                'data' => 'a'
            ],
            1 => (object) [
                'id' => 1,
                'data' => 'b'
            ],
            2 => (object) [
                'id' => 2,
                'data' => 'c'
            ]
        ];

        $result = $this->formatter->getProductUsingId($inputData, 2);
        $this->assertEquals('c', $result->data);
    }

    /**
     * Data for testFormatProducts
     *
     * @return object
     */
    private function productsData()
    {
        $rawInput = [
            (object)[
                'name' => 'name',
                'product_id' => 'product id',
                'image' => 'image',
                'colour_code' => '#colorcode'
            ],
            (object)[
                'name' => 'fgfd',
                'product_id' => 'gfdsgfdsgf id',
                'image' => 'reqcregtrsvgs',
                'colour_code' => '#fffFFF'
            ]
        ];
        $input = new Collection($rawInput);
        $rawOutput = [
            (object)[
                'name' => 'name',
                'value' => 'product id',
                'image' => 'image',
                'colour' => '#colorcode'
            ],
            (object)[
                'name' => 'fgfd',
                'value' => 'gfdsgfdsgf id',
                'image' => 'reqcregtrsvgs',
                'colour' => '#fffFFF'
            ]
        ];
        $output = json_encode($rawOutput);
        return (object)[
            'input' => $input,
            'output' => $output
        ];
    }

    /**
     * Data for testFormatMergeFields
     *
     * @return object
     */
    private function mergeFieldsData()
    {
        $rawInput = [
            (object)[
                'name' => 'name',
                'tag' => 'tag',
                'type' => 'type',
                'choices' => [
                    (object)['value' => 'ONE'],
                    (object)['value' => 'TWO'],
                    (object)['value' => 'THREE']
                ]
            ],
            (object)[
                'name' => 'name',
                'tag' => 'tag',
                'type' => 'type',
                'choices' => []
            ]
        ];
        $input = new Collection($rawInput);

        $rawOutput = [
            (object)[
                "placeholder" => "name",
                "tag" => "tag",
                "type" => "type",
                "choices" => [
                    "ONE",
                    "TWO",
                    "THREE"
                ]
            ],
            (object)[
                "placeholder" => "name",
                "tag" => "tag",
                "type" => "type"
            ]
        ];
        $output = json_encode($rawOutput);
        return (object)[
            'input' => $input,
            'output' => $output
        ];
    }
}
