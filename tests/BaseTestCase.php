<?php

namespace KlinikPintar\Tests;

use KlinikPintar\KlinikPintarServiceProvider;
use Orchestra\Testbench\Concerns\CreatesApplication;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class BaseTestCase extends OrchestraTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            KlinikPintarServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
