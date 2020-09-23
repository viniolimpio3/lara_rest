<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     * @param Faker 
     * @return array
     */
    public function definition(){
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 0, 8),
            'description' => $this->faker->text
        ];
    }
}
