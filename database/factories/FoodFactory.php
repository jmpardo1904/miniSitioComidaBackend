<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Food;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FoodFactory extends Factory
{
    protected $model = Food::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word,
            'foto' => $this->faker->imageUrl(400, 300),
            'descripcion' => $this->faker->sentence,
        ];
    }
}
