<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;
class TransactionFactory extends Factory
{

    public function definition(): array
    {
        return [
            'value' => fake()->randomFloat(2, 0, 9999999999), //randomFloat($decimais, $min, $max)
            'description' => fake()->text(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
