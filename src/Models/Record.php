<?php

namespace Jeodns\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jeodns\Database\Factories\RecordFactory;
use Jeodns\PDNSManager\Contracts\IRecord;
use Jeodns\PDNSManager\Contracts\IZone;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;

/**
 * @property int    $id
 * @property int    $zone_id
 * @property IZone  $zone
 * @property string $name
 * @property Type   $type
 * @property int    $ttl
 * @property bool   $geobase
 * @property Status $status
 */
class Record extends Model implements IRecord
{
    use HasFactory;

    protected static function newFactory(): RecordFactory
    {
        return RecordFactory::new();
    }

    /**
     * @return BelongsTo<Zone,Record>;
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @var string
     */
    protected $table = 'jeodns_records';

    /**
     * @var string[]
     */
    protected $fillable = ['zone_id', 'name', 'type', 'ttl', 'geobase', 'status'];

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

    public function getZoneID(): int
    {
        return $this->zone_id;
    }

    public function getZone(): IZone
    {
        /** @var IZone */
        return $this->zone;
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

    public function getData(): Collection
    {
        return $this->data;
    }
}
