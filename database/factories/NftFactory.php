<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->domainName(),
            'price' => random_int(5, 50) . '.' . random_int(0, 99),
            'image_url' => fake()->url()
        ];
    }
}
