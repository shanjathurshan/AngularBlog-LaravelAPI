<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

// $factory->define(App\Models\Product::class, function (Faker $faker) {
//     return [
        // 'name' => $faker->name,
        // 'slug' => $faker->unique()->safeEmail,
        // // 'description' => now(),
        // 'price' => Str::random(10),
//     ];
// });

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
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->name,
            'description' => $this->faker->name,
            'price' => $this->faker->name,
        ];
    }
    
}
