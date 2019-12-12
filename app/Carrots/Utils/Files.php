<?php

namespace App\Carrots\Utils;

use Exception;

class Files {

    private $carrotPath;
    private $baseFilePath;

    public function __construct()
    {
        $this->carrotPath = \public_path() . '/popups/carrots/';
        $this->baseFilePath = $this->carrotPath . 'generatedHeadScript.js';
    }


    /**
     * Return contents of base carrot javascript file
     *
     * @return string contents
     */
    public function readBaseFile()
    {
        return file_get_contents($this->baseFilePath);
    }

    /**
     * Put a new file to the carrots public directory
     *
     * @param string $filename
     * @param string $contents
     * @return string $filepath
     */
    public function putNewFile(string $filename, string $contents)
    {
        $filepath = $this->carrotPath . $filename;
        file_put_contents($filepath, $contents);
        return $filepath;
    }

}