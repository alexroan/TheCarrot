<?php

namespace App\Carrots\Utils;

class Files
{
    private $environmentCheck;

    private $carrotPath;
    private $baseFilePath;
    private $putPath;

    public function __construct()
    {
        $this->environmentCheck = app(EnvironmentCheck::class);

        $this->carrotPath = \public_path() . '/popups/carrots/';
        $this->baseFilePath = $this->carrotPath . 'generatedHeadScript.js';
        $this->putPath = $this->carrotPath . 'generated/';
    }

    /**
     * Deletes generated files, only if the environment allows
     *
     */
    public function deleteGeneratedFiles()
    {
        $this->environmentCheck->isDev();

        $files = glob($this->putPath . '*');
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
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
     * @param  string $filename
     * @param  string $contents
     * @return string $filepath
     */
    public function putNewFile(string $filename, string $contents)
    {
        $filepath = $this->putPath . $filename;
        $written = file_put_contents($filepath, $contents);
        if ($written) {
            $permissioned = chmod($filepath, 0674);
            if ($permissioned) {
                return $filepath;
            }
        }
        return false;
    }
}
