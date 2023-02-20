<?php

namespace Jeodns\Database\Factories;
 
use Jeodns\PDNSManager\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Jeodns\PDNSManager\Contracts\Zone\Status;
use Illuminate\Support\Str;
 
class ZoneFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(9).'.com',
			'status' => Status::ACTIVE,
        ];
    }
}
