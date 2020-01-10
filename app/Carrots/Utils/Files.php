<?php

namespace App\Carrots\Utils;

class Files
{
    private $environmentCheck;

    private $carrotPath;
    private $compiledJsTemplate;
    private $htmlTemplate;
    private $compiledJsPath;
    private $generatedHtmlPath;

    public function __construct()
    {
        $this->environmentCheck = app(EnvironmentCheck::class);

        $this->carrotPath = \public_path() . '/popups/carrots/';
        $this->compiledJsTemplate = $this->carrotPath . 'compiledTemplate.js';
        $this->htmlTemplate = $this->carrotPath . 'htmlTemplate.html';
        $this->compiledJsPath = $this->carrotPath . 'compiled/';
        $this->generatedHtmlPath = $this->carrotPath . 'html/';
    }

    /**
     * Deletes generated files, only if the environment allows
     *
     */
    public function deleteGeneratedFiles()
    {
        $this->environmentCheck->isDev();

        $files = glob($this->compiledJsPath . '*');
        $this->unlinkFiles($files);
        $files = glob($this->generatedHtmlPath . '*');
        $this->unlinkFiles($files);
    }

    private function unlinkFiles($files)
    {
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }

    public function readFile(string $filepath)
    {
        return file_get_contents($filepath);
    }

    public function readHtmlTemplate()
    {
        return file_get_contents($this->htmlTemplate);
    }

    /**
     * Return contents of base carrot javascript file
     *
     * @return string contents
     */
    public function readBaseFile()
    {
        return file_get_contents($this->compiledJsTemplate);
    }

    public function putHtmlFile(string $filename, string $contents)
    {
        $filepath = $this->generatedHtmlPath . $filename;
        $written = file_put_contents($filepath, $contents);
        if ($written) {
            $permissioned = chmod($filepath, 0674);
            if ($permissioned) {
                return $filepath;
            }
        }
        return false;
    }

    /**
     * Put a new file to the carrots public directory
     *
     * @param  string $filename
     * @param  string $contents
     * @return string $filepath
     */
    public function putCompiledJsFile(string $filename, string $contents)
    {
        $filepath = $this->compiledJsPath . $filename;
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
