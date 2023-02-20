<?php

namespace Jeodns\Database\Factories;
 
use Jeodns\PDNSManager\Models\Server;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Jeodns\PDNSManager\Contracts\Server\Status;
 
class ServerFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Server::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::random(10),
            'type' => Str::random(100),
            'connectionArgs' => [
                'hostname' => 'api.domain.com',
                'token' => Str::random(100),
            ],
            'status' => Status::ACTIVE,
        ];
    }
}
