<?php

namespace App\Carrots\Utils;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class EnvironmentCheck
{

    /**
     * Checks that this is a dev environment
     *
     * @return boolean
     */
    public function isDev()
    {
        if (!App::environment('local')) {
            Log::info("Cannot run this script in anything other than LOCAL environment");
            throw new Exception("Cannot run this script in anything other than LOCAL environment");
        }
        return true;
    }
}
