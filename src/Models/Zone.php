<?php

namespace Jeodns\PDNSManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jeodns\Database\Factories\ZoneFactory;
use Jeodns\PDNSManager\Contracts\IZone;
use Jeodns\PDNSManager\Contracts\Zone\Status;

/**
 * @property string $name
 * @property Status $status
 */
class Zone extends Model implements IZone
{
    use HasFactory;

    protected static function newFactory(): ZoneFactory
    {
        return ZoneFactory::new();
    }

    /**
     * @var string
     */
    protected $table = 'pdns_zones';

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
