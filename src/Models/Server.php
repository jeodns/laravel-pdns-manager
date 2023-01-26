<?php

namespace Jeodns\Models;

use Illuminate\Database\Eloquent\Model;
use Jeodns\PDNSManager\Contracts\IServer;
use Jeodns\PDNSManager\Contracts\Server\Status;

/**
 * @phpstan-import-type ConnectionArgs from IServer
 *
 * @property string         $title
 * @property class-string   $type
 * @property ConnectionArgs $connectionArgs
 * @property Status         $status
 */
class Server extends Model implements IServer
{
    /**
     * @var string
     */
    protected $table = 'jeodns_servers';

    /**
     * @var string[]
     */
    protected $fillable = ['title', 'type', 'connectionArgs', 'status'];

    protected $casts = [
        'status' => Status::class,
        'connectionArgs' => 'array',
    ];

    public function getID(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getConnectionArgs(): array
    {
        return $this->connectionArgs;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
