<?php

namespace App\Carrots\Utils;

function file_get_contents(string $filepath)
{
    return $filepath;
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

    public function testReadBaseFile()
    {
        print_r($this->files->readBaseFile());
    }

    public function testPutNewFile()
    {

    }
}