<?php

namespace Jeodns\PDNSManager;

use Illuminate\Support\Facades\DB;
use Jeodns\PDNSManager\Contracts\IRecordManager;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\Models\Record;

class RecordManager implements IRecordManager
{
    public IZoneManager $zoneManager;

    public function __construct(IZoneManager $zoneManager)
    {
        $this->zoneManager = $zoneManager;
    }

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
        $name = $this->validateName($zoneID, $name);

        return DB::transaction(fn () => Record::create([
            'zone_id' => $zoneID,
            'name' => $name,
            'type' => $type,
            'ttl' => max(0, $ttl),
            'geobase' => $geobase,
            'status' => $status,
        ]));
    }

    public function update(int $id, array $changes = []): Record
    {
        foreach ($changes as $name => $value) {
            switch ($name) {
                case 'type':
                    /** @var Type $value */
                    if (!($value instanceof Type)) {
                        throw new Exception('Record type must be type of '.Type::class);
                    }
                    break;
                case 'name':
                    $record = $this->getByID($id);

                    if ($value !== $record->getName()) {
                        $changes['name'] = $this->validateName($record->getZoneID(), $value);
                    }
                    break;
                case 'ttl':
                    if (!is_int($value) or $value < 0) {
                        throw new Exception('Record ttl must be positive number.');
                    }
                    break;
                case 'geobase':
                    if (!is_bool($value)) {
                        throw new Exception('Record geobase can get a boolean value.');
                    }
                    break;
                case 'status':
                    if (!($value instanceof Status)) {
                        throw new Exception('Record status must be type of '.Status::class);
                    }
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

    private function validateName(int $zoneID, string $name): string
    {
        $zone = $this->zoneManager->getByID($zoneID);

        if ('.' === substr($name, -1)) {
            $name = substr($name, 0, -1);

            if (!preg_match('/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu', $name)) {
                throw new Exception('Name is not a valid domain.');
            }

            $zoneDomainLen = strlen($zone->getName());

            if ($name == $zone->getName()) {
                $name = '@';
            } else {
                if ($zone->getName() !== substr($name, -1 * $zoneDomainLen)) {
                    throw new Exception('Record name is not a valid subdomain of Zone.');
                }

                $name = substr($name, 0, $zoneDomainLen - 1);
            }
        }

        return $name;
    }
}
