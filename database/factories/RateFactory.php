<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rate>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency_id' => Currency::factory(),
            'city_id' => City::factory(),

            'buy_price' => fn ($attributes) => $attributes['currency_id'] == Currency::SAR
                ? fake()->randomFloat(2, 1, 300)
                : fake()->randomFloat(2, 500, 1000),
            'sell_price' => fn ($attributes) => $attributes['currency_id'] == Currency::SAR
                ? fake()->randomFloat(2, 1, 300)
                : fake()->randomFloat(2, 500, 1000),

            'date' => fake()->dateTimeBetween('-20 days', 'today'),
        ];
    }

    public function withDate($date)
    {
        return $this->state([
            'date' => $date,
        ]);
    }

    public function today()
    {
        return $this->state([
            'date' => now(),
        ]);
    }

    public function yesterday()
    {
        return $this->state([
            'date' => now()->subDay(),
        ]);
    }

    public function last20Days()
    {
        return $this->state([
            'date' => fake()->unique()->dateTimeBetween('-20 days', 'yesterday'),
        ]);
    }
}
