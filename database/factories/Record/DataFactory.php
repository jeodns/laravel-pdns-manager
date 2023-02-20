<?php

namespace Jeodns\Database\Factories\Record;
 
use Jeodns\PDNSManager\Models\Record;
use Jeodns\PDNSManager\Models\Record\Data;
use Illuminate\Database\Eloquent\Factories\Factory;
use Jeodns\PDNSManager\Contracts\Record\Data\Status;
 
class DataFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Data::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'record_id' => Record::factory()->create()->getID(),
            'content' => ["127.0.0.1"],
            'status' => Status::ACTIVE,
        ];
    }
}
