<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index($type) {
        $typeMapping = ['games' => 'game', 'apps' => 'app', 'windows' => 'window'];
        $mappedType = $typeMapping[$type] ?? abort(404);
    
        $categories = Category::where('type', $mappedType)->get();
        abort_if($categories->isEmpty(), 404);
    
        $mainCategory = $categories->first();
    
        view()->share('seoData', [
            'title' => "{$mainCategory->type} - APKRebel Play",
            'canonical' => url()->current(),
        ]);
    
        $items = App::with('developer')
                    ->whereIn('category_id', $categories->pluck('id'))
                    ->get();
    
        return view("frontend.$type.index", compact('items', 'categories') + [$type => $items]);
    }      

    public function show($id) {
        $app = App::with(['developer', 'category', 'screenshots', 'versions'])->findOrFail($id);
    
        $seoData = [
            'title' => $app->name . ' - Ứng dụng',
            'canonical' => url('/apps/' . $id),
        ];
    
        return view('frontend.apps.details', compact('app', 'seoData'));
    }    

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $seoData['title'] = "$keyword - Các ứng dụng trên APKRebel Play";
        $seoData['canonical'] = url('/search');
        
        view()->share([
            'seoData' => $seoData
        ]);

        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
        }

        $apps = App::with(['developer', 'category'])
        ->where('name', 'LIKE', "%$keyword%")
        ->orWhere('description', 'LIKE', "%$keyword%")
        // ->orWhere('package_name', 'LIKE', "%$keyword%")
        ->orWhereHas('developer', fn($q) => $q->where('name', 'LIKE', "%$keyword%"))
        ->orWhereHas('category', fn($q) => $q->where('name', 'LIKE', "%$keyword%"))
        ->orderByRaw("LENGTH(name) - LENGTH(REPLACE(name, ?, '')) DESC", [$keyword])
        ->orderBy('total_downloads', 'desc') 
        ->orderBy('average_rating', 'desc') 
        ->take(10)
        ->get();

        return view('frontend.apps.list', compact('apps', 'keyword'));
    }

    public function loadMore(Request $request)
    {
        $keyword = $request->input('query');
        $offset = $request->input('offset', 0);

        $apps = App::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('description', 'LIKE', "%$keyword%")
                    ->orderBy('downloads', 'desc')
                    ->skip($offset)
                    ->take(10)
                    ->get();

        return response()->json($apps);
    }
}
