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
            'name' => $this->faker->sentence(3),
            'price' => random_int(5, 100) . '.' . random_int(0, 99),
        ];
    }
}
