<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $this->faker->unique()->name,
            'slug' => $this->faker->slug,
            'code' => Str::random(10),
            'category_id' => rand(0,9),
            'width' =>100,
            'length' =>100,
            'height' =>10,
            'price' =>1000000,
            'color' =>'Xám đen',
            'images' =>$this->faker->imageUrl(),
            'description' => $this->faker->text,
        ];
    }
}
