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
        DB::beginTransaction();

        $zone = null;

        try {
            $zone = Zone::create([
                'name' => $name,
                'status' => $status,
            ]);

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();

            throw $t;
        }

        return $zone;
    }

    public function update(int $id, array $changes = []): Zone
    {
        $zone = $this->getByID($id);

        foreach ($changes as $name => $value) {
            if (!in_array($name, ['name', 'status'])) {
                throw new Exception('Can not edit zone parameter with name: '.$name);
            }
        }

        DB::beginTransaction();

        try {
            foreach ($changes as $name => $value) {
                $zone->$name = $value;
            }

            $zone->save();

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();

            throw $t;
        }

        return $zone;
    }

    public function delete(int $id): Zone
    {
        $zone = $this->getByID($id);

        try {
            DB::beginTransaction();

            $zone->delete();

            DB::commit();
        } catch (\Throwable $t) {
            DB::rollBack();

            throw $t;
        }

        return $zone;
    }
}
