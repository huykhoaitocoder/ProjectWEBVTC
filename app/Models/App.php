<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    
    protected $table = 'apps';

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

    public function screenshots() {
        return $this->hasMany(Screenshot::class);
    }
    
    public function versions() {
        return $this->hasMany(AppVersion::class)->orderByDesc('version_code');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
