<?php

namespace Jeodns\PDNSManager;

use Jeodns\Models\Zone;
use Jeodns\PDNSManager\Contracts\IPowerDNSManager;
use Jeodns\PDNSManager\Contracts\IZoneManager;
use Jeodns\PDNSManager\Contracts\Zone\Status;
use Jeodns\PDNSManager\Exceptions\Exception;

class ZoneManager implements IZoneManager
{
    public IPowerDNSManager $powerDNSManager;

    public function __construct(IPowerDNSManager $powerDNSManager)
    {
        $this->powerDNSManager = $powerDNSManager;
    }

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
        $zone = Zone::create([
            'name' => $name,
            'status' => $status,
        ]);

        try {
            $this->powerDNSManager->reloadAll();
        } catch (Exception $e) {
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

            $zone->$name = $value;
        }

        $zone->save();

        try {
            $this->powerDNSManager->reloadAll();
        } catch (Exception $e) {
        }

        return $zone;
    }

    public function delete(int $id): Zone
    {
        $zone = $this->getByID($id);

        $zone->delete();

        try {
            $this->powerDNSManager->reloadAll();
        } catch (Exception $e) {
        }

        return $zone;
    }
}
