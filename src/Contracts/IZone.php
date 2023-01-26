<?php

namespace Jeodns\PDNSManager\Contracts;

use Jeodns\PDNSManager\Contracts\Zone\Status;

interface IZone
{
    public function getID(): int;

    public function getName(): string;

    public function getStatus(): Status;
}
