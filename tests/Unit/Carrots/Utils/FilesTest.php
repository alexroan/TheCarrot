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
    if ($filepath == (\public_path() . "/popups/carrots/compiled/")) {
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
function glob(string $pattern)
{
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
function is_file(string $file)
{
    return true;
}

/**
 * Override system function
 *
 * @param string $file
 * @return void
 */
function unlink(string $file)
{
    return true;
}

/**
 * Override system function
 *
 * @param string $filepath
 * @param integer $mode
 * @return void
 */
function chmod(string $filepath, int $mode)
{
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
     * Test read file
     *
     */
    public function testReadFile()
    {
        $filepath = "fsgfdsgfdsgfdsgf";
        $file = $this->files->readFile($filepath);

        $this->assertEquals($filepath, $file);
    }

    /**
     * Test read html template
     *
     */
    public function testReadHtmlTemplate()
    {
        $expected = \public_path() . '/popups/carrots/htmlTemplate.html';
        $fileToRead = $this->files->readHtmlTemplate();
        $this->assertEquals($expected, $fileToRead);
    }

    /**
     * Test readJsTemplate()
     */
    public function testReadJsTemplate()
    {
        $expected = \public_path() . '/popups/carrots/compiledTemplate.js';
        $fileToRead = $this->files->readJsTemplate();
        $this->assertEquals($expected, $fileToRead);
    }

    /**
     * Data provider for testPutNewFile
     *
     * @return array
     */
    public function putCompiledJsFileDataProvider()
    {
        $putPath = '/popups/carrots/compiled/';
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
     * @dataProvider putCompiledJsFileDataProvider
     *
     * @param  string $filename
     * @param  string $contents
     * @param  mixed  $expected
     * @return void
     */
    public function testPutCompiledJsFile($filename, $contents, $expected)
    {
        if ($expected != false) {
            $expected = \public_path() . $expected;
        }
        $returned = $this->files->putCompiledJsFile($filename, $contents);
        $this->assertEquals($expected, $returned);
    }
}
