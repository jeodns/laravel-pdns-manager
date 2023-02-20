<?php

namespace Jeodns\PDNSManager\Tests\Feature;

use Jeodns\Models\Record;
use Jeodns\Models\Zone;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\RecordManager;
use Jeodns\PDNSManager\Tests\TestCase;

class RecordManagerTest extends TestCase
{
    public function testCreate(): void
    {
        $record = $this->getManager()->add(
            zoneID: Zone::factory()->create()->getID(),
            name: 'ns1.domain.com',
            type: Type::A,
            ttl: 30,
            geobase: false,
            status: Status::ACTIVE,
        );

        $this->assertInstanceOf(Record::class, $record);
    }

    public function testGetByID(): void
    {
        $record = Record::factory()->create();
        $recordCopy = $this->getManager()->getByID($record->getID());

        $this->assertTrue(
            $record->getID() == $recordCopy->getID() and
            $record->getZoneID() == $recordCopy->getZoneID() and
            $record->getZone()->getID() == $recordCopy->getZone()->getID() and
            $record->getName() == $recordCopy->getName() and
            $record->getType() == $recordCopy->getType() and
            $record->getTTL() == $recordCopy->getTTL() and
            $record->isGeobase() == $recordCopy->isGeobase() and
            $record->getData() == $recordCopy->getData() and
            $record->getStatus() == $recordCopy->getStatus()
        );
    }

    public function testGetByIDWithException(): void
    {
        $this->expectException(Exception::class);

        $record = $this->getManager()->getByID(2);
    }

    public function testGetByIDAndZone(): void
    {
        $record = Record::factory()->create();
        $recordCopy = $this->getManager()->getByIDAndZone($record->getID(), $record->getZoneID());

        $this->assertTrue($record->getID() == $recordCopy->getID());
    }

    public function testGetByIDAndZoneWithException(): void
    {
        $this->expectException(Exception::class);
        $record = $this->getManager()->getByIDAndZone(2, 3);
    }

    public function testUpdate(): void
    {
        $record = Record::factory()->create();

        $updatedRecord = $this->getManager()->update(
            id: $record->getID(),
            changes: [
                'ttl' => 60,
                'type' => Type::AAAA,
                'geobase' => true,
                'status' => Status::DEACTIVE,
            ],
        );

        $this->assertTrue(
            $record->getID() == $updatedRecord->getID() and
            $updatedRecord->isGeobase() and
            Type::AAAA == $updatedRecord->getType() and
            Status::DEACTIVE == $updatedRecord->getStatus()
        );
    }

    public function testUpdateWithException(): void
    {
        $this->expectException(Exception::class);

        $record = Record::factory()->create();

        $updatedRecord = $this->getManager()->update(
            id: $record->getID(),
            changes: [
                'domain' => 'newdomain.com',
            ],
        );
    }

    public function testUpdateWithInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $record = Record::factory()->create();

        $updatedRecord = $this->getManager()->update(
            id: $record->getID(),
            changes: [
                'type' => 'hi',
            ],
        );
    }

    public function testDelete(): void
    {
        $record = Record::factory()->create();

        $this->getManager()->delete($record->getID());

        $this->assertDatabaseMissing(Record::class, [
            'name' => $record->getName(),
        ]);
    }

    protected function getManager(): RecordManager
    {
        if (!$this->app) {
            throw new \Exception('App is not defined.');
        }

        return $this->app->make(IRecordManager::class);
    }
}
