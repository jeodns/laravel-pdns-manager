<?php

namespace Jeodns\PDNSManager\Record;

use Jeodns\Models\Record\Data;
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\Exceptions\Exception;

class DataManager implements IDataManager
{
    public IPowerDNSManager $powerDNSManager;

    public function __construct(IPowerDNSManager $powerDNSManager)
    {
        $this->powerDNSManager = $powerDNSManager;
    }

    public function getByID(int $id): Data
    {
        $record = Data::find($id);

        if (!$record) {
            throw new Exception('Can not find any record data by id: '.$id);
        }

        return $record;
    }

    public function add(int $recordID, int $weight, int $priority, int $locationID, array $content, Status $status): Data
    {
        $data = Data::create([
            'record_id' => $recordID,
            'weight' => $weight,
            'priority' => $priority,
            'location_id' => $locationID,
            'content' => $content,
            'status' => $status,
        ]);

        try {
            $this->powerDNSManager->reloadAll();
        } catch (Exception $e) {
        }

        return $data;
    }

    public function update(int $id, array $changes = []): Data
    {
        $record = $this->getByID($id);

        foreach ($changes as $name => $value) {
            switch ($name) {
                case 'weight':
                case 'priority':
                case 'location_id':
                case 'content':
                case 'status':
                    $record->$name = $value;
                    break;
                default:
                    throw new Exception('Can not edit record parameter with name: '.$name);
            }
        }

        $record->save();

        try {
            $this->powerDNSManager->reloadAll();
        } catch (Exception $e) {
        }

        return $this->getByID($id);
    }

    public function delete(int $id): Data
    {
        $record = $this->getByID($id);

        $record->delete();

        try {
            $this->powerDNSManager->reloadAll();
        } catch (Exception $e) {
        }

        return $record;
    }
}
