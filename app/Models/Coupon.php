<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['app_id', 'code', 'discount_percentage', 'max_usage', 'used_count', 'expiration_date', 'status'];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    protected $casts = [
        'expiration_date' => 'datetime', // Ép kiểu thành Carbon
    ];
}
