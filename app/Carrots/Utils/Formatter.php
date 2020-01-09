<?php

namespace App\Carrots\Utils;

use Illuminate\Support\Facades\Log;

class Formatter
{

    /**
     * Format carrot to usable url
     *
     * @param  string $filepath
     * @return string $filepath
     */
    public function formatUrl(string $filepath)
    {
        $filepath = strstr($filepath, "/popups/carrots/compiled/");
        $filepath = config('app.url') . $filepath;
        return $filepath;
    }
}
