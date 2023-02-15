<?php

namespace Jeodns\PDNSManager\Contracts;

use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;

interface IRecord
{
    public function getID(): int;

    public function getZoneID(): int;

    public function getZone(): IZone;

    public function getName(): string;

    public function getType(): Type;

    public function getTTL(): int;

    public function isGeobase(): bool;

    public function getStatus(): Status;

    /**
     * @return IData[]
     */
    public function getData(): array;
}
