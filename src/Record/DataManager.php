<?php

namespace Jeodns\PDNSManager\Record;

use Illuminate\Support\Facades\DB;
use Jeodns\Models\Record\Data;
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IDataManager;
use Jeodns\PDNSManager\Exceptions\Exception;

class DataManager implements IDataManager
{
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
        foreach (array_keys($changes) as $name) {
            if (!in_array($name, ['weight', 'priority', 'location_id', 'content', 'status'])) {
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
