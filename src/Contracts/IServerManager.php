<?php

namespace Jeodns\PDNSManager\Contracts;

use dnj\Filesystem\Local\File;
use Jeodns\PDNSManager\Contracts\Server\Status;

/**
 * @phpstan-import-type ConnectionArgs from IServer
 */
interface IServerManager
{
    public function getByID(int $id): IServer;

    /**
     * @param ConnectionArgs $connectionArgs
     */
    public function add(string $title, string $type, array $connectionArgs): IServer;

    /**
     * @param array{title?:string,status?:Status,connectionArgs?:ConnectionArgs} $changes
     */
    public function update(int $id, array $changes): IServer;

    public function delete(int $id): IServer;

    public function reload(File $file): void;
}
