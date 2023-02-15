<?php

namespace Jeodns\Database\Factories;
 
use Jeodns\Models\Zone;
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
            'name' => 'domain.com',
			'status' => Status::ACTIVE,
        ];
    }
}
