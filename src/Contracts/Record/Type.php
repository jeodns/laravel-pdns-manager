<?php

namespace Jeodns\PDNSManager\Contracts\Record;

enum Type: string
{
    case A = 'A';
    case NS = 'NS';
    case MX = 'MX';
    case SOA = 'SOA';
    case CNAME = 'CNAME';
    case PTR = 'PTR';
    case TXT = 'TXT';
    case SRV = 'SRV';
    case AAAA = 'AAAA';
}
