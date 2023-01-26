<?php

namespace Jeodns\PDNSManager\Contracts\Server;

enum Status: int
{
    case ACTIVE = 1;
    case DEACTIVE = 2;
}
