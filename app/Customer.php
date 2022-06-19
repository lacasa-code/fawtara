<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;
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
