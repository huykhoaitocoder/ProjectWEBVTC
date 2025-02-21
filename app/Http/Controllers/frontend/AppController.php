<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function show($id) {
        
        $app = App::findOrFail($id);
        $userHasPurchased = false; 

        if (auth()->check()) {
            $userHasPurchased = auth()->user()->purchases()->where('app_id', $id)->exists();
        }      

        $seoData['title'] = $app->name . ' - Ứng dụng';
        $seoData['canonical'] = url('/apps/' . $id);

        return view('frontend.apps.details', compact('app', 'userHasPurchased', 'seoData'));
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
