<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->sentence(2),
            'descricao' => fake()->text(),
            'codigo' => 'PROD' . fake()->ean13(),
            'marca' => fake()->words(rand(1, 2), true),
            'preco' => number_format(fake()->randomFloat(2, 10, 100)),
            'qtd_disponivel' => fake()->numberBetween(0, 100),
        ];
    }
}
