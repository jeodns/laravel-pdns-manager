<?php

namespace Jeodns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jeodns\Models\Location\Weight;
use Jeodns\PDNSManager\Contracts\ILocation;
use Jeodns\PDNSManager\Contracts\Location\Continent;
use Jeodns\PDNSManager\Exceptions\Exception;

/**
 * @property int       $id
 * @property Continent $continent
 * @property string    $country
 * @property string    $state
 */
class Location extends Model implements ILocation
{
    /**
     * @var string
     */
    protected $table = 'jeodns_locations';

    /**
     * @var string[]
     */
    protected $fillable = ['continent', 'country', 'state'];

    protected $casts = [
        'continent' => Continent::class,
    ];

    public $timestamps = false;

    /**
     * @return HasMany<Weight>
     */
    public function weights()
    {
        return $this->hasMany(Location\Weight::class, 'src_id');
    }

    public function equals(ILocation $other): bool
    {
        return $other instanceof self and $other->id == $this->id;
    }

    /**
     * @param Location[]|null $to
     *
     * @return Weight[]
     */
    public function getWeights(?array $to): array
    {
        $query = Location\Weight::query()->where('src_id', $this->id);
        if (null !== $to) {
            $to = array_map(function ($to) {
                if (!$to instanceof self) {
                    throw new Exception();
                }

                return $to->id;
            }, $to);
            $query->whereIn('dst_id', $to);
        }

        return $query->get()->all();
    }

    public function getWeight(ILocation $to): ?Weight
    {
        if (!$to instanceof self) {
            throw new Exception();
        }
        $weight = Location\Weight::query()
            ->where('src_id', $this->id)
            ->where('dst_id', $to->id)
            ->first();

        return $weight;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getContinent(): Continent
    {
        return $this->continent;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
