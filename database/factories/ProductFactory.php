<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 5, 2500),
            'delivery_time' => $this->faker->randomDigitNot(0),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->addMediaFromUrl('http://lorempixel.com/200/200/food/')->toMediaCollection();
        });
    }
    
}
