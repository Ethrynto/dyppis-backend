<?php

namespace Database\Factories\ProductService;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductService\Product>
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
            'id' => $this->faker->uuid(),
            'slug' => $this->faker->slug(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(100, 9999),
            'old_price' => $this->faker->numberBetween(100, 9999),
            'platform_id' => '0' . $this->faker->numberBetween(1, 9) . 'e1fe30-0ee9-4fb0-b89f-b746b5d2a6fd',
            'category_id' => '0' . $this->faker->numberBetween(1, 8) . 'ed9ab4-b75d-46a3-90d3-420b39dfa4f1',
            'delivery_id' => '0' . $this->faker->numberBetween(1, 5) . 'e36ceb-ba4b-4017-a7e1-88ffccd3295a',
        ];
    }
}
