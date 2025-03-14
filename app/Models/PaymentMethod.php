<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $table = 'payment_methods';
    protected $fillable = [
        'name', 'description', 'status',
        'icon_url', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function payments()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
