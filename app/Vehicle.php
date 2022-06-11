<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;

class Vehicle extends Model
{
	//For 
	protected $table = 'tbl_vehicles';
    


	public function scopeGetByUser($query, $id) 
	{
        $role = getUsersRole(Auth::User()->role_id);
        if (isAdmin(Auth::User()->role_id)) 
        {
            return $query;
        } 
        else 
        {
            return $query->where('id', Auth::User()->id);
        }
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
    
}
