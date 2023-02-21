<?php

namespace Jeodns\PDNSManager;

use Illuminate\Support\Facades\DB;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Zone\Status;
use Jeodns\PDNSManager\Exceptions\Exception;
use Jeodns\PDNSManager\Models\Zone;

class ZoneManager implements IZoneManager
{
    public function getByID(int $id): Zone
    {
        $zone = Zone::find($id);

        if (!$zone) {
            throw new Exception('Can not find any zone by id: '.$id);
        }

        return $zone;
    }

    public function add(string $name, Status $status): Zone
    {
        if (!preg_match('/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu', $name)) {
            throw new Exception('Name is not a valid domain.');
        }

        return DB::transaction(fn () => Zone::create([
            'name' => $name,
            'status' => $status,
        ]));
    }

    public function update(int $id, array $changes = []): Zone
    {
        foreach ($changes as $name => $value) {
            switch ($name) {
                case 'name':
                    if (!preg_match('/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu', $value)) {
                        throw new Exception('Name is not a valid domain.');
                    }
                    break;
                case 'status':
                    if (!($value instanceof Status)) {
                        throw new Exception('Status is not a valid status.');
                    }
                    break;
                default:
                    throw new Exception('Can not edit zone parameter with name: '.$name);
            }
        }

        return DB::transaction(function () use ($id, $changes) {
            $zone = $this->getByID($id);

            foreach ($changes as $name => $value) {
                $zone->$name = $value;
            }

            $zone->save();

            return $zone;
        });
    }

    public function delete(int $id): Zone
    {
        return DB::transaction(function () use ($id) {
            $zone = $this->getByID($id);

            $zone->delete();

            return $zone;
        });
    }
}
