<?php

namespace Jeodns\Models\Record;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeodns\Database\Factories\Record\DataFactory;
use Jeodns\LocationSelector\Contracts\ILocation;
use Jeodns\Models\Record;
use Jeodns\PDNSManager\Contracts\IRecord;
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
use Jeodns\PDNSManager\Contracts\Record\IData;

/**
 * @phpstan-import-type Content from IData
 *
 * @property int     $id
 * @property int     $record_id
 * @property int     $weight
 * @property int     $priority
 * @property int     $location_id
 * @property Content $content
 * @property Status  $status
 */
class Data extends Model implements IData
{
    use HasFactory;

    protected static function newFactory(): DataFactory
    {
        return DataFactory::new();
    }

    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    /**
     * @var string
     */
    protected $table = 'jeodns_records_data';

    /**
     * @var string[]
     */
    protected $fillable = ['record_id', 'content', 'status'];

    protected $casts = [
        'status' => Status::class,
        'content' => 'array',
    ];

    /**
     * @return BelongsTo<Record,Data>;
     */
    public function record()
    {
        return $this->belongsTo(Record::class);
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getRecordID(): int
    {
        return $this->record_id;
    }

    public function getRecord(): IRecord
    {
        /** @var IRecord */
        return $this->record;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function getLocationID(): ?int
    {
        return $this->location_id;
    }

    public function getLocation(): ?ILocation
    {
        /** @var ILocation */
        return $this->loaction;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }
}
