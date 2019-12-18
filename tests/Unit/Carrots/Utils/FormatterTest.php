<?php

namespace App\Carrots\Utils;

use App\Carrots\Utils\Formatter;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class FormatterTest extends TestCase
{
    private $formatter;

    public function setUp() : void
    {
        parent::setUp();

        $this->formatter = new Formatter();
    }

    /**
     * Test format URL
     *
     * @return void
     */
    public function testFormatUrl()
    {
        $baseUrl = \getenv("BASE_URL");
        $filepathPrefix = '/www/thecarrot/public/';
        $filePath = 'path/to/file.js';
        
        $formattedUrl = $this->formatter->formatUrl($filepathPrefix . $filePath);
        $this->assertEquals(($baseUrl . "/" . $filePath), $formattedUrl);
    }

    /**
     * Test formatMergeFields
     */
    public function testFormatMergeFields()
    {
        $data = $this->mergeFieldsData();
        $formatted = $this->formatter->formatMergeFields($data->input);
        $this->assertEquals($data->output, $formatted);
    }

    /**
     * Test formatProducts
     */
    public function testFormatProducts()
    {
        $data = $this->productsData();
        $formatted = $this->formatter->formatProducts($data->input);
        $this->assertEquals($data->output, $formatted);
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
                'image' => 'image'
            ],
            (object)[
                'name' => 'fgfd',
                'product_id' => 'gfdsgfdsgf id',
                'image' => 'reqcregtrsvgs'
            ]
        ];
        $input = new Collection($rawInput);
        $rawOutput = [
            (object)[
                'name' => 'name',
                'value' => 'product id',
                'image' => 'image'
            ],
            (object)[
                'name' => 'fgfd',
                'value' => 'gfdsgfdsgf id',
                'image' => 'reqcregtrsvgs'
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