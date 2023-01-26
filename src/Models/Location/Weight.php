<?php

namespace Jeodns\Models\Location;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jeodns\LocationSelector\Contracts\ILocation;
use Jeodns\LocationSelector\Contracts\IWeight;
use Jeodns\Models\Location;

/**
 * @property int   $id
 * @property int   $src_id
 * @property int   $dst_id
 * @property float $weight
 */
class Weight extends Model implements IWeight
{
    public const CREATED_AT = null;

    /**
     * @var string
     */
    protected $table = 'jeodns_locations_weights';

    /**
     * @var string[]
     */
    protected $fillable = ['src_id', 'dst_id', 'updated_at', 'weight'];

    /**
     * @return BelongsTo<Location,Weight>
     */
    public function src()
    {
        return $this->belongsTo(Location::class, 'src_id');
    }

    /**
     * @return BelongsTo<Location,Weight>
     */
    public function dst()
    {
        return $this->belongsTo(Location::class, 'dst_id');
    }

    public function getSource(): ILocation
    {
        /** @var ILocation */
        return $this->src;
    }

    public function getDestination(): ILocation
    {
        /** @var ILocation */
        return $this->dst;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}
