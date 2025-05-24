<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /** @use HasFactory<\Database\Factories\CityFactory> */
    use HasFactory;

    const SANAA = 'sanaa';

    const ADEN = 'aden';

    protected $fillable = [
        'name',
        'label',
    ];

    /**
     * Get all supported cities
     */
    public static function supportedCities(): array
    {
        return [
            self::SANAA,
            self::ADEN,
        ];
    }
}
