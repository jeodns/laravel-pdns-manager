<?php

namespace Jeodns\Models;

use Illuminate\Database\Eloquent\Model;
use Jeodns\PDNSManager\Contracts\ILocation;
use Jeodns\PDNSManager\Contracts\Location\Continent;

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

    public function equals(ILocation $other): bool
    {
        return $other instanceof self and $other->id == $this->id;
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
