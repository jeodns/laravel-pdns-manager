<?php

namespace Jeodns\PDNSManager\Contracts;

use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;

interface IRecordManager
{
    public function getByID(int $id): IRecord;

    public function getByIDAndZone(int $id, int $zoneID): IRecord;

    public function add(int $zoneID, string $name, Type $type, int $ttl, bool $geobase, Status $status): IRecord;

    /**
     * @param array{type?:Type,name?:string,ttl?:int,geobase?:bool,status?:Status} $changes
     */
    public function update(int $id, array $changes): IRecord;

    public function delete(int $id): IRecord;
}
