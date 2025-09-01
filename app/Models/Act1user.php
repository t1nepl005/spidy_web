<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class act1user extends Model
{
    /** @use HasFactory<\Database\Factories\Act1userFactory> */
    use HasFactory;
    // first name, last name, address, gender, contact, email
    protected $fillable = [
        'first_name', 'last_name', 'address', 'gender', 'contact', 'email'
    ];

}
