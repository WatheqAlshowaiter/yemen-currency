<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'city_id',
        'buy_price',
        'sell_price',
        'date',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
