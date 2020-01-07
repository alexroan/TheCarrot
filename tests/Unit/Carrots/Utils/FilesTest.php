<?php

namespace App\Carrots\Utils;

/**
 * Override system function in the files class
 *
 * @param string $filepath
 *
 * @return string same filepath
 */
function file_get_contents(string $filepath)
{
    return $filepath;
}

/**
 * Override system function in the files class
 *
 * @param  string $filepath
 * @param  string $contents
 * @return mixed bool or string
 */
function file_put_contents(string $filepath, string $contents)
{
    if ($filepath == (\public_path() . "/popups/carrots/generated/")) {
        return false;
    }

    return ($filepath . $contents);
}

/**
 * Override system function
 *
 * @param string $pattern
 * @return array
 */
function glob(string $pattern) {
    return [
        "1",
        "2",
        "3",
        "4"
    ];
}

/**
 * Override system function
 *
 * @param string $file
 * @return boolean
 */
function is_file(string $file) {
    return true;
}

/**
 * Override system function
 *
 * @param string $file
 * @return void
 */
function unlink(string $file) {
    return true;
}

use Mockery;
use Tests\TestCase;

class FilesTest extends TestCase
{
    private $files;

    private $environmentCheck;

    /**
     * Setup
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();
        
        $this->environmentCheck = Mockery::mock(EnvironmentCheck::class);
        $this->app->instance(EnvironmentCheck::class, $this->environmentCheck);
        
        $this->files = new Files();
    }

    /**
     * Test that deleting generated files works
     *
     */
    public function testDeleteGeneratedFiles()
    {
        $this->environmentCheck->shouldReceive('isDev')
            ->once()
            ->andReturn(true);

        $this->files->deleteGeneratedFiles();
    }

    /**
     * Test readBaseFile()
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
                'expected' => ($putPath . $happyFile)
            ],
            'sad' => [
                'filename' => $sadFile,
                'contents' => $contents,
                'expected' => false
            ]
        ];
    }

    /**
     * Test put new file
     *
     * @dataProvider putNewFileDataProvider
     *
     * @param  string $filename
     * @param  string $contents
     * @param  mixed  $expected
     * @return void
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
