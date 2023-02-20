<?php

namespace Jeodns\PDNSManager\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Jeodns\Database\Seeders\DatabaseSeeder;
use Jeodns\PDNSManager\ServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Run a specific seeder before each test.
     *
     * @var string
     */
    protected $seeder = DatabaseSeeder::class;

    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
