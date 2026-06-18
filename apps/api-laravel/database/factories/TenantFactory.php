<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tenant;

class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'theme_id'      => 1,
            'vertical_id' => 2,
            'name'         => $this->faker->name(),
            'subdomain'    => 'localhost:3000',
            'description'  => $this->faker->text(),
            'registry_id'  => $this->faker->numberBetween(1000, 20000),
            'email'        => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'status' => Tenant::STATUS_ACTIVE,
        ];
    }
}
