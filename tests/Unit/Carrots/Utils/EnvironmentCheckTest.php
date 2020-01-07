<?php

namespace App\Carrots\Utils;

use Exception;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class EnvironmentCheckTest extends TestCase
{

    /**
     * Test that isDev works as expected
     *
     */
    public function testIsDev()
    {
        $environmentCheck = new EnvironmentCheck();

        \putenv("APP_ENV=production");

        Log::shouldReceive('info')
            ->once()
            ->with("Cannot run this script in anything other than LOCAL environment");
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Cannot run this script in anything other than LOCAL environment");
        $environmentCheck->isDev();

        \putenv("APP_ENV=local");
        $isDev = $environmentCheck->isDev();
        $this->assertTrue($isDev);
    }
}
