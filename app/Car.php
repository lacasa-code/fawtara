<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'manufacturing',
        'registration',
        'manufacturing_date',
        'chassis',
        'model', 
        'kilometers',
        'reg_chars',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);

    }
}
