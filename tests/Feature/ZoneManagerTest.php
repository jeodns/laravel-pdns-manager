<?php

namespace Jeodns\PDNSManager\Tests\Feature;

use Jeodns\Models\Zone;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Zone\Status;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\Tests\TestCase;
use Jeodns\PDNSManager\ZoneManager;

class ZoneManagerTest extends TestCase
{
    public function testCreate(): void
    {
        $zone = $this->getManager()->add('domain.com', Status::ACTIVE);

        $this->assertInstanceOf(Zone::class, $zone);
    }

    public function testGetByID(): void
    {
        $zone = Zone::factory()->create();
        $zoneCopy = $this->getManager()->getByID($zone->getID());

        $this->assertSame($zone->getID(), $zoneCopy->getID());
    }

    public function testGetByIDWithException(): void
    {
        $this->expectException(Exception::class);

        $zone = $this->getManager()->getByID(2);
    }

    public function testUpdate(): void
    {
        $zone = Zone::factory()->create();

        $updatedZone = $this->getManager()->update(
            id: $zone->getID(),
            changes: [
                'name' => 'newdomain.com',
                'status' => Status::DEACTIVE,
            ],
        );

        $this->assertTrue(
            $zone->getID() == $updatedZone->getID() and
            'newdomain.com' == $updatedZone->getName() and
            Status::DEACTIVE == $updatedZone->getStatus()
        );
    }

    public function testUpdateWithException(): void
    {
        $this->expectException(Exception::class);

        $zone = Zone::factory()->create();

        $updatedZone = $this->getManager()->update(
            id: $zone->getID(),
            changes: [
                'domain' => 'newdomain.com',
                'status' => Status::DEACTIVE,
            ],
        );
    }

    public function testDelete(): void
    {
        $zone = Zone::factory()->create();

        $this->getManager()->delete($zone->getID());

        $this->assertDatabaseMissing(Zone::class, [
            'name' => 'domain.com',
        ]);
    }

    protected function getManager(): ZoneManager
    {
        if (!$this->app) {
            throw new \Exception('App is not defined.');
        }

        return $this->app->make(IZoneManager::class);
    }
}
