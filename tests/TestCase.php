<?php

namespace Jeodns\PDNSManager\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jeodns\PDNSManager\ServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
