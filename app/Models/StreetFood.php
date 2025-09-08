<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreetFood extends Model
{
    /** @use HasFactory<\Database\Factories\StreetFoodFactory> */
    use HasFactory;
    protected $fillable = [
        'food_name',
        'description',
        'price',
        'stock_quantity',
    ];
}
