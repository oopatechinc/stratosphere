<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname'      => $this->faker->firstName,
            'lastname'       => $this->faker->lastName,
            'email'          => $this->faker->unique()->safeEmail,
            'password'       => bcrypt('secret'),
        ];
    }
}
