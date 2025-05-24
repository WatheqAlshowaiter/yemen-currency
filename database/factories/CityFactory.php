<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(City::supportedCities()),
        ];
    }

    public function sanaa()
    {
        return $this->state([
            'name' => City::SANAA,
            'label' => 'صنعاء',
        ]);
    }

    public function aden()
    {
        return $this->state([
            'name' => City::ADEN,
            'label' => 'عدن',
        ]);
    }
}
