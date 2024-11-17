<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
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
        $name = $this->faker->words(2, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(),
            'active' => $this->faker->boolean,
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
        ];
    }

    /**
     * Indicate that the product is active.
     *
     * @return \Database\Factories\ProductFactory
     */
    public function active(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => true,
            ];
        });
    }

    /**
     * Indicate that the product is inactive.
     *
     * @return \Database\Factories\ProductFactory
     */
    public function inactive(): ProductFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false,
            ];
        });
    }
}
