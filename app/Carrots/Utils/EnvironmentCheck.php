<?php

namespace App\Carrots\Utils;

class EnvironmentCheck
{

    /**
     * Checks that this is a dev environment
     *
     * @return boolean
     */
    public function isDev()
    {
        $environment = \getenv('APP_ENV');
        if ($environment != 'local') {
            Log::info("Cannot run this script in anything other than LOCAL environment");
            throw new Exception("Cannot run this script in anything other than LOCAL environment");
        }
        return true;
    }
}
