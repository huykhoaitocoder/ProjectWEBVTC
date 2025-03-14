<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Tên bảng trong database
    public $timestamps = false;
    protected $fillable = [
        'purchase_id',
        'payment_method',
        'transaction_id',
        'status',
        'created_at'

    ];

    // Quan hệ: Một thanh toán thuộc về một đơn hàng
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
