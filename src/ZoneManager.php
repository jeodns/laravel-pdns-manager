<?php

namespace Jeodns\PDNSManager;

use Illuminate\Support\Facades\DB;
use Jeodns\Models\Zone;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Zone\Status;
use Jeodns\PDNSManager\Exceptions\Exception;

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
        return DB::transaction(function () use ($name, $status) {
            return Zone::create([
                'name' => $name,
                'status' => $status,
            ]);
        });
    }

    public function update(int $id, array $changes = []): Zone
    {
        foreach ($changes as $name => $value) {
            if (!in_array($name, ['name', 'status'])) {
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
