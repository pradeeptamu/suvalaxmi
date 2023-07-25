<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purpose' => $this->faker->randomElement(['sell', 'rent']),
            'type' => $this->faker->randomElement(['residential', 'commercial']),
            'category' => $this->faker->randomElement(['house', 'land', 'apartment']),
            'status' => $this->faker->boolean(),
            'address' => $this->faker->streetAddress,
            'location' => $this->faker->city,
            'images' => '...',
            'thumbnail' => '...',
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'area_total' => $this->faker->randomFloat(2, 50, 500),
            'area_built' => $this->faker->optional()->randomFloat(2, 30, 300),
            'face' => $this->faker->randomElement(['north', 'south', 'east', 'west']),
            'road_size' => $this->faker->randomFloat(2, 5, 50),
            'road_type' => $this->faker->randomElement(['paved', 'gravel']),
            'price' => $this->faker->numberBetween(50000, 500000),
            'price_unit' => $this->faker->optional()->randomElement(['USD', 'EUR']),
            'views' => $this->faker->optional()->numberBetween(0, 1000),
            'owner_id' => $this->faker->randomElement(\App\Models\User::pluck('id')->toArray()),
        ];
    }
}
