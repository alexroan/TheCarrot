<?php

namespace App\Console\Commands;

use App\Carrots\Utils\EnvironmentCheck;
use App\Carrots\Utils\Files;
use App\Data\CleanupDataAccessor;
use Mockery;
use Tests\TestCase;

class ClearDevWithoutFreshMigrationTest extends TestCase
{
    private $environmentCheck;
    private $cleanupAccessor;
    private $files;

    public function setUp() : void
    {
        parent::setUp();

        $this->environmentCheck = Mockery::mock(EnvironmentCheck::class);
        $this->cleanupAccessor = Mockery::mock(CleanupDataAccessor::class);
        $this->files = Mockery::mock(Files::class);

        $this->app->instance(EnvironmentCheck::class, $this->environmentCheck);
        $this->app->instance(CleanupDataAccessor::class, $this->cleanupAccessor);
        $this->app->instance(Files::class, $this->files);
    }

    /**
     * Test handle function
     *
     */
    public function testHandle()
    {
        $clearDev = new ClearDevWithoutFreshMigration();

        $this->environmentCheck->shouldReceive('isDev')
            ->once()
            ->andReturn(true);
        $this->cleanupAccessor->shouldReceive('truncateCarrots')
            ->once();
        $this->cleanupAccessor->shouldReceive('releaseDiscountCodes')
            ->once();
        $this->cleanupAccessor->shouldReceive('truncateLogImpressions')
            ->once();
        $this->cleanupAccessor->shouldReceive('truncateLogSubscribers')
            ->once();
        $this->cleanupAccessor->shouldReceive('truncateLogAlreadySubscribed')
            ->once();
        $this->files->shouldReceive('deleteGeneratedFiles')
            ->once();

        $clearDev->handle();
    }
}
