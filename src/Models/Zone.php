<?php

namespace Jeodns\Models;

use Illuminate\Database\Eloquent\Model;
use Jeodns\PDNSManager\Contracts\IZone;
use Jeodns\PDNSManager\Contracts\Zone\Status;

/**
 * @property string $name
 * @property Status $status
 */
class Zone extends Model implements IZone
{
    /**
     * @var string
     */
    protected $table = 'jeodns_zones';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'status'];

    protected $casts = [
        'status' => Status::class,
    ];

    public function getID(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
