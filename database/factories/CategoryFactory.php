<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
            'description' => $this->faker->text,
        ];
    }
}
