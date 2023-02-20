<?php

namespace Jeodns\PDNSManager;

use Illuminate\Support\ServiceProvider as ParentServiceProvider;
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\IServerManager;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\Console\Commands\DatabaseSeederCommand;

class ServiceProvider extends ParentServiceProvider
{
    public function register()
    {
        $this->app->singleton(IServerManager::class, ServerManager::class);
        $this->app->singleton(IRecordManager::class, RecordManager::class);
        $this->app->singleton(IZoneManager::class, ZoneManager::class);
        $this->app->singleton(IPowerDNSManager::class, PowerDNSManager::class);
        $this->app->singleton(IDataManager::class, Record\DataManager::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                DatabaseSeederCommand::class,
            ]);
        }
    }
}
