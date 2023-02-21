<?php

namespace Jeodns\PDNSManager\Record;

use Illuminate\Support\Facades\DB;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\Models\Record\Data;

class DataManager implements IDataManager
{
    public IRecordManager $recordManager;

    public function __construct(IRecordManager $recordManager)
    {
        $this->recordManager = $recordManager;
    }

    public function getByID(int $id): Data
    {
        $data = Data::find($id);

        if (!$data) {
            throw new Exception('Can not find any record data by id: '.$id);
        }

        return $data;
    }

    public function add(int $recordID, array $content, Status $status, ?int $weight = null, ?int $priority = null, ?int $locationID = null): Data
    {
        $record = $this->recordManager->getByID($recordID);

        if ($record->isGeobase() and is_null($locationID)) {
            throw new Exception('Location id must be set in geobase records.');
        }

        return DB::transaction(fn () => Data::create([
            'record_id' => $recordID,
            'weight' => $weight,
            'priority' => $priority,
            'location_id' => $locationID,
            'content' => $content,
            'status' => $status,
        ]));
    }

    public function update(int $id, array $changes = []): Data
    {
        $data = $this->getByID($id);

        foreach ($changes as $name => $value) {
            switch ($name) {
                case 'location_id':
                    if (is_null($value) and $data->getRecord()->isGeobase()) {
                        throw new Exception('Location id must be set in geobase records.');
                    }
                    break;
                case 'weight':
                case 'priority':
                case 'content':
                    break;
                case 'status':
                    if (!($value instanceof Status)) {
                        throw new Exception('Record Data status must be type of '.Status::class);
                    }
                    break;
                default:
                    throw new Exception('Can not edit record parameter with name: '.$name);
            }
        }

        return DB::transaction(function () use ($id, $changes) {
            $data = $this->getByID($id);

            foreach ($changes as $name => $value) {
                $data->$name = $value;
            }

            $data->save();

            return $data;
        });
    }

    public function delete(int $id): Data
    {
        return DB::transaction(function () use ($id) {
            $data = $this->getByID($id);

            $data->delete();

            return $data;
        });
    }
}
