<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'developer_id', 'category_id', 'name','description',
        'package_name', 'price', 'icon', 'status',
        'total_downloads', 'average_rating'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id');
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }
    
    public function versions() {
        return $this->hasMany(AppVersion::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
