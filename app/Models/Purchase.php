<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchases'; 

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'app_id',
        'amount',
        'payment_status',
        'created_at'
    ]; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    /**
     * Kiểm tra xem giao dịch đã hoàn thành chưa
     */
    public function isCompleted()
    {
        return $this->payment_status === 'completed';
    }
}
