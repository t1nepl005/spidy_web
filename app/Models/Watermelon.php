<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watermelon extends Model
{
    /** @use HasFactory<\Database\Factories\WatermelonFactory> */
    use HasFactory;

    protected $fillable = [
        'color',
        'size',
        'price'
    ];
}
