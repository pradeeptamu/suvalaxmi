<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ApartmentHouse;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ApartmentHouseFactory extends Factory
{
    protected $model = ApartmentHouse::class;

    /**
     * Define the model's default state.
    
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'property_id' => $this->faker->randomElement($this->getPropertyIds()),
        'built_year' => $this->faker->numberBetween(1900, date('Y')),
        'no_floors' => $this->faker->numberBetween(1, 10),
        'furnish_status' => $this->faker->randomElement(['Furnished', 'Semi-furnished', 'Unfurnished']),
        'kitchen' => $this->faker->numberBetween(1, 5),
        'bedroom' => $this->faker->numberBetween(1, 5),
        'bathroom' => $this->faker->numberBetween(1, 5),
        'living_room' => $this->faker->numberBetween(1, 3),
        'parking' => $this->faker->numberBetween(0, 3),
        'amenities' => $this->faker->sentence(),
    ];
    }

    public function getPropertyIds()
    {
        return DB::table('properties')->pluck('id');
    }

    public function configure()
    {
        return $this->state(function (array $attributes) {
            return [
                'property_id' => $this->faker->randomElement($this->getPropertyIds()),
            ];
        });
    }
}
