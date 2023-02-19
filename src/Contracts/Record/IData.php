<?php

namespace Jeodns\PDNSManager\Contracts\Record;

use Jeodns\PDNSManager\Contracts\ILocation;
use Jeodns\PDNSManager\Contracts\IRecord;
use Jeodns\PDNSManager\Contracts\Record\Data\Status;

/**
 * @phpstan-type Content string[]
 */
interface IData
{
    public function getID(): int;

    public function getRecordID(): int;

    public function getRecord(): IRecord;

    public function getWeight(): ?int;

    public function getPriority(): ?int;

    public function getLocationID(): ?int;

    public function getLocation(): ?ILocation;

    /**
     * @return Content
     */
    public function getContent(): array;

    public function getStatus(): Status;
}
