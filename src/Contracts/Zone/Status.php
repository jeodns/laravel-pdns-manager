<?php

namespace Jeodns\PDNSManager\Contracts\Zone;

enum Status: int
{
    case ACTIVE = 1;
    case DEACTIVE = 2;
}
