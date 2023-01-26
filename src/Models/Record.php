<?php

namespace Jeodns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jeodns\PDNSManager\Contracts\IRecord;
use Jeodns\PDNSManager\Contracts\Record\IData;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;

/**
 * @property int    $id
 * @property string $name
 * @property Type   $type
 * @property int    $ttl
 * @property bool   $geobase
 * @property Status $status
 */
class Record extends Model implements IRecord
{
    /**
     * @var string
     */
    protected $table = 'jeodns_records';

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'type', 'ttl', 'geobase', 'status'];

    protected $casts = [
        'status' => Status::class,
        'type' => Type::class,
        'geobase' => 'boolean',
    ];

    /**
     * @return HasMany<Record\Data>
     */
    public function data()
    {
        return $this->hasMany(Record\Data::class);
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getTTL(): int
    {
        return $this->ttl;
    }

    public function isGeobase(): bool
    {
        return $this->geobase;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getData(): array
    {
        /** @var IData[] */
        return $this->data;
    }
}
