<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = 'Product ' . ucfirst($this->faker->name),
            'slug' => Str::slug($name),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(3000, 10000)
        ];
    }
}
