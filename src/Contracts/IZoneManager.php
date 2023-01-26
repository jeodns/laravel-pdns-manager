<?php

namespace Jeodns\PDNSManager\Contracts;

use Jeodns\PDNSManager\Contracts\Zone\Status;

interface IZoneManager
{
    public function getByID(int $id): IZone;

    public function add(string $name, Status $status): IZone;

    /**
     * @param array{name?:string,status?:Status} $changes
     */
    public function update(int $id, array $changes): IZone;

    public function delete(int $id): IZone;
}
