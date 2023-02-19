<?php

namespace Jeodns\PDNSManager\Contracts\Location;

use Jeodns\PDNSManager\Contracts\ILocation;

interface IWeight
{
    public function getSource(): ILocation;

    public function getDestination(): ILocation;

    public function getWeight(): float;
}
