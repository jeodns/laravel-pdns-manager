<?php

namespace Jeodns\PDNSManager\Contracts;

use dnj\Filesystem\Local\File;

interface IPowerDNSManager
{
    public function generateConfigYaml(): File;

    public function reload(int $serverID): void;

    public function reloadAll(): void;
}
