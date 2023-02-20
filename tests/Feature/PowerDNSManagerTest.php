<?php

namespace Jeodns\PDNSManager\Tests\Feature;

use Jeodns\Models\Record;
use Jeodns\Models\Record\Data;
use Jeodns\Models\Server;
use Jeodns\Models\Zone;
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\IServerConnection;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\PowerDNSManager;
use Jeodns\PDNSManager\Tests\TestCase;

class PowerDNSManagerTest extends TestCase
{
    public function testGenerateConfigYaml(): void
    {
        $zone = Zone::factory()->create();
        $record = Record::factory()->create([
            'zone_id' => $zone->getID(),
            'ttl' => 3600,
        ]);
        $data = Data::factory()->create([
            'record_id' => $record->getID(),
        ]);
        $record = Record::factory()->create([
            'zone_id' => $zone->getID(),
        ]);
        $data = Data::factory()->create([
            'record_id' => $record->getID(),
        ]);
        $record = Record::factory()->create([
            'zone_id' => $zone->getID(),
            'geobase' => true,
        ]);
        $data = Data::factory()->create([
            'record_id' => $record->getID(),
        ]);

        $file = $this->getManager()->generateConfigYaml();

        $this->assertTrue($file->exists());
    }

    public function testReload(): void
    {
        $server = Server::factory()->create();

        $this->getManager()->reload($server->getID());

        $this->assertNotInstanceOf(\Exception::class, \Throwable::class);
    }

    public function testRealoadAll(): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $server = Server::factory()->create();
        }

        $this->getManager()->reloadAll();

        $this->assertNotInstanceOf(\Exception::class, \Throwable::class);
    }

    protected function getManager(): PowerDNSManager
    {
        if (!$this->app) {
            throw new \Exception('App is not defined.');
        }

        $this->app->singleton(IServerConnection::class, fn () => $this->createMock(IServerConnection::class));

        $this->app->make(IZoneManager::class);
        $this->app->make(IRecordManager::class);
        $this->app->make(IDataManager::class);
        $this->app->make(IServerConnection::class);

        return $this->app->make(IPowerDNSManager::class);
    }
}
