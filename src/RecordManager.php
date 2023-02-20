<?php

namespace Jeodns\PDNSManager;

use Illuminate\Support\Facades\DB;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\Models\Record;

class RecordManager implements IRecordManager
{
    public function getByID(int $id): Record
    {
        $record = Record::find($id);

        if (!$record) {
            throw new Exception('Can not find any record by id: '.$id);
        }

        return $record;
    }

    public function getByIDAndZone(int $id, int $zoneID): Record
    {
        $query = Record::where('zone_id', $zoneID);
        $record = $query->find($id);

        if (!$record) {
            throw new Exception('Can not find any record by zone id: '.$zoneID.' and id: '.$id);
        }

        return $record;
    }

    public function add(int $zoneID, string $name, Type $type, int $ttl, bool $geobase, Status $status): Record
    {
        return DB::transaction(function () use ($zoneID, $name, $type, $ttl, $geobase, $status) {
            return Record::create([
                'zone_id' => $zoneID,
                'name' => $name,
                'type' => $type,
                'ttl' => $ttl,
                'geobase' => $geobase,
                'status' => $status,
            ]);
        });
    }

    public function update(int $id, array $changes = []): Record
    {
        foreach ($changes as $name => $value) {
            switch ($name) {
                case 'type':
                    /** @var Type $value */
                    if (!($value instanceof Type)) {
                        throw new \InvalidArgumentException('record type must be typeof: '.Type::class);
                    }
                    break;
                case 'name':
                case 'ttl':
                case 'geobase':
                case 'status':
                    break;
                default:
                    throw new Exception('Can not edit record parameter with name: '.$name);
            }
        }

        return DB::transaction(function () use ($id, $changes) {
            $record = $this->getByID($id);

            foreach ($changes as $name => $value) {
                $record->$name = $value;
            }

            $record->save();

            return $record;
        });
    }

    public function delete(int $id): Record
    {
        return DB::transaction(function () use ($id) {
            $record = $this->getByID($id);

            $record->delete();

            return $record;
        });
    }
}
