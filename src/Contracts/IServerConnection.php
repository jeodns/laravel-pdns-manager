<?php

namespace Jeodns\PDNSManager\Contracts;

use dnj\Filesystem\Local;

interface IServerConnection
{
    public function verifyConnection(int $serverId): void;

    public function reload(int $serverId, Local\File $file): void;
}
