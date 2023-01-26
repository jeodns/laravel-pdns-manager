<?php

namespace Jeodns\PDNSManager\Contracts\Record;

enum Status: int
{
    case ACTIVE = 1;
    case DEACTIVE = 2;
}
