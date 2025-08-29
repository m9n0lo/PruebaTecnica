<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productos>
 */
class ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'       => fake()->words(3, true),
            'precio'       => fake()->randomFloat(2, 1000, 500000),
            'categoria_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'descripcion'  => fake()->sentence(12),
            'stock'        => fake()->numberBetween(0, 500),
            'imagen'       => null,
        ];
    }
}
