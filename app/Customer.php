<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'mail',
    ];

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
