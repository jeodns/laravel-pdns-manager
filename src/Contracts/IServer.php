<?php

namespace Jeodns\PDNSManager\Contracts;

use Jeodns\PDNSManager\Contracts\Server\Status;

/**
 * @phpstan-type ArrayKey array{string,string|int|bool|string[]|int[]}
 * @phpstan-type ConnectionArgs string[]|ArrayKey
 */
interface IServer
{
    public function getID(): int;

    public function getTitle(): string;

    /**
     * @return class-string
     */
    public function getType(): string;

    /**
     * @return ConnectionArgs
     */
    public function getConnectionArgs(): array;

    public function getStatus(): Status;
}
