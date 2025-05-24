<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /** @use HasFactory<\Database\Factories\CurrencyFactory> */
    use HasFactory;

    /**
     * The supported currency codes.
     */
    const USD = 'USD';

    const SAR = 'SAR';

    protected $fillable = [
        'code',
        'name',
        'symbol',
    ];

    /**
     * Get all supported currency codes
     */
    public static function supportedCurrencies(): array
    {
        return [
            self::USD,
            self::SAR,
        ];
    }
}
