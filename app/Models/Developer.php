<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'full_name',
        'name',          
        'email',        
        'phone',         
        'address',       
        'website',       
        'status'         
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apps()
    {
        return $this->hasMany(App::class);
    }    
}
