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
        $generatedPath = "/popups/carrots/compiled/123.js";
        $url = "anything/which/could/possibly/go/here".$generatedPath;

        $formatted = $this->formatter->formatUrl($url);
        $expected = 'app.url' . $generatedPath;
        $this->assertEquals($expected, $formatted);
    }
}
