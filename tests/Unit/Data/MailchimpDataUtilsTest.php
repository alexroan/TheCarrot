<?php

namespace App\Data;

use Tests\TestCase;

class MailchimpDataUtilsTest extends TestCase
{

    private $mailchimpDataUtils;

    public function setUp() : void
    {
        parent::setUp();

        $this->mailchimpDataUtils = new MailchimpDataUtils();
    }

    /**
     * Test that conversion works correctly
     *
     */
    public function testConvertingInternalFields()
    {
        $parameters = [
            "first" => "1",
            "MERGE||second" => "2",
            "third" => "3",
            "fourth" => "4",
            "MERGE||fifth" => "5"
        ];
        $expected = [
            "first" => "1",
            "MERGE||second" => "2",
            "third" => "3",
            "fourth" => "4",
            "MERGE||fifth" => "5",
            "merge_fields" => [
                "second" => "2",
                "fifth" => "5"
            ]
        ];
        $result = $this->mailchimpDataUtils->convertMergeFieldsToMailchimpFields($parameters);
        $this->assertEquals($expected, $result);
    }
}
