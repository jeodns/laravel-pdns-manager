<?php

namespace Jeodns\PDNSManager\Tests\Feature;

use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\Models\Record;
use Jeodns\PDNSManager\Models\Record\Data;
use Jeodns\PDNSManager\Record\DataManager;
use Jeodns\PDNSManager\Tests\TestCase;

class DataManagerTest extends TestCase
{
    public function testCreate(): void
    {
        $data = $this->getManager()->add(
            recordID: Record::factory()->create()->getID(),
            content: [
                '127.0.0.1',
                '127.0.0.2',
            ],
            status: Status::ACTIVE,
        );

        $this->assertInstanceOf(Data::class, $data);
    }

    public function testGetByID(): void
    {
        $data = Data::factory()->create();
        $dataCopy = $this->getManager()->getByID($data->getID());

        $this->assertTrue(
            $data->getID() == $dataCopy->getID() and
            $data->getRecordID() == $dataCopy->getRecordID() and
            $data->getRecord()->getID() == $dataCopy->getRecord()->getID() and
            $data->getContent() == $dataCopy->getContent() and
            $data->getWeight() == $dataCopy->getWeight() and
            $data->getPriority() == $dataCopy->getPriority() and
            $data->getLocationID() == $dataCopy->getLocationID() and
            $data->getLocation() == $dataCopy->getLocation() and
            $data->getStatus() == $dataCopy->getStatus()
        );
    }

    public function testGetByIDWithException(): void
    {
        $this->expectException(Exception::class);

        $data = $this->getManager()->getByID(2);
    }

    public function testUpdate(): void
    {
        $data = Data::factory()->create();

        $updatedData = $this->getManager()->update(
            id: $data->getID(),
            changes: [
                'content' => ['localhost'],
                'status' => Status::DEACTIVE,
            ],
        );

        $this->assertTrue(
            $data->getID() == $updatedData->getID() and
            Status::DEACTIVE == $updatedData->getStatus()
        );
    }

    public function testUpdateWithException(): void
    {
        $this->expectException(Exception::class);

        $data = Data::factory()->create();

        $updatedData = $this->getManager()->update(
            id: $data->getID(),
            changes: [
                'domain' => 'newdomain.com',
            ],
        );
    }

    public function testDelete(): void
    {
        $data = Data::factory()->create();

        $this->getManager()->delete($data->getID());

        $this->assertDatabaseMissing(Data::class, [
            'record_id' => $data->getRecordID(),
        ]);
    }

    protected function getManager(): DataManager
    {
        if (!$this->app) {
            throw new \Exception('App is not defined.');
        }

        return $this->app->make(IDataManager::class);
    }
}
