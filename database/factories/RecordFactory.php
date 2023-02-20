<?php

namespace Jeodns\Database\Factories;
 
use Jeodns\Models\Zone;
use Jeodns\Models\Record;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Jeodns\PDNSManager\Contracts\Record\Status;
use Jeodns\PDNSManager\Contracts\Record\Type;
 
class RecordFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zone_id' => Zone::factory()->create()->getID(),
            'name' => Str::random(3),
            'type' => Type::A,
            'ttl' => 30,
            'geobase' => false,
            'status' => Status::ACTIVE,
        ];
    }
}
