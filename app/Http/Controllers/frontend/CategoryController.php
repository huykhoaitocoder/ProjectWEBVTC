<?php

namespace App\Http\Controllers\frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $apps = $category->apps()->paginate(10); 

        return view('frontend.categories.show', compact('category', 'apps'));
    }
}
