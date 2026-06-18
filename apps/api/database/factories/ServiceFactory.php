<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => 1,
            'name' => $this->faker->company,
            'price' => $this->faker->numberBetween(30, 100),
            'duration' => $this->faker->randomElement([30, 60, 90]),
            'description' => $this->faker->realText(30),
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
