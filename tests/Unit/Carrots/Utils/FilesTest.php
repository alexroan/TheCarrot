<?php

namespace App\Carrots\Utils;

/**
 * Override system function in the files class
 *
 * @param string $filepath
 * @return string same filepath
 */
function file_get_contents(string $filepath)
{
    return $filepath;
}

/**
 * Override system function in the files class
 *
 * @param string $filepath
 * @param string $contents
 * @return mixed bool or string
 */
function file_put_contents(string $filepath, string $contents)
{
    if ($filepath == (\public_path() . "/popups/carrots/generated/")) {
        return false;
    }

    return ($filepath . $contents);
}

use Tests\TestCase;

class FilesTest extends TestCase
{
    private $files;

    public function setUp() : void
    {
        parent::setUp();
        $this->files = new Files();
    }

    /**
     * Test readBaseFile()
     *
     */
    public function testReadBaseFile()
    {
        $expected = \public_path() . '/popups/carrots/generatedHeadScript.js';
        $fileToRead = $this->files->readBaseFile();
        $this->assertEquals($expected, $fileToRead);
    }

    /**
     * Data provider for testPutNewFile
     *
     * @return array
     */
    public function putNewFileDataProvider()
    {
        $putPath = '/popups/carrots/generated/';
        $happyFile = 'a/path/to/file.js';
        $sadFile = "";
        $contents = 'some contents\nto the file';
        return [
            'happy' => [
                'filename' => $happyFile,
                'contents' => $contents,
                'expected' => ($putPath . $happyFile . $contents)
            ],
            'sad' => [
                'filename' => $sadFile,
                'contents' => $contents,
                'expected' => false
            ]
        ];
    }
    
    /**
     * Test putNewFile
     * 
     * @dataProvider putNewFileDataProvider
     *
     */
    public function testPutNewFile($filename, $contents, $expected)
    {
        if ($expected != false) {
            $expected = \public_path() . $expected;
        }
        $returned = $this->files->putNewFile($filename, $contents);
        $this->assertEquals($expected, $returned);
    }
}