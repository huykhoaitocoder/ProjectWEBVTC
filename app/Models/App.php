<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'apps';

    public function category()
    {
        // belongsTo ho biết mỗi ứng dụng (app) thuộc về một danh mục (category)
        return $this->belongsTo(Category::class);
    }
}
