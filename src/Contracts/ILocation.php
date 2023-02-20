<?php

namespace Jeodns\PDNSManager\Contracts;

use Jeodns\PDNSManager\Contracts\Location\Continent;

interface ILocation
{
    public function getID(): int;

    public function getContinent(): Continent;

    public function getCountry(): string;

    public function getState(): ?string;
}
