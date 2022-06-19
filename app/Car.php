<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'customer_id',
        'manufacturing',
        'registration',
        'manufacturing_date',
        'chassis',
        'model', 
        'kilometers'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);

    }
}
