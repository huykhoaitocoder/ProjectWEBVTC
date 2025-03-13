<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id', 'version_name',
        'changelog', 'apk_path', 'file_size',
        'screenshots', 'video', 'status'
    ];

    protected $casts = [
        'screenshots' => 'array',
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function getFileSizeAttribute($value)
    {
        return round($value / (1024 * 1024), 2);
    }
}
