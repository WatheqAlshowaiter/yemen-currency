<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $code = fake()->randomElement(Currency::supportedCurrencies());

        $name = match ($code) {
            Currency::USD => 'دولار أمريكي',
            Currency::SAR => 'ريال سعودي',
        };

        $symbol = match ($code) {
            Currency::USD => '$',
            Currency::SAR => '﷼',
        };

        return [
            'code' => $code,
            'name' => $name,
            'symbol' => $symbol,
        ];
    }

    public function saudiRial()
    {
        return $this->state([
            'code' => Currency::SAR,
            'name' => 'ريال سعودي',
            'symbol' => '﷼',
        ]);
    }

    public function usdDollar()
    {
        return $this->state([
            'code' => Currency::USD,
            'name' => 'دولار أمريكي',
            'symbol' => '$',
        ]);
    }
}
