<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->sentence(),
            "description"=>fake()->paragraph(),
            "price"=>fake()->randomFloat(null,5,1000),
            "sale_price"=>fake()->randomFloat(null,5,1000),
            "quantity"=>fake()->randomDigit(),
            "status"=>fake()->randomElement(["active","inactive"]),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
