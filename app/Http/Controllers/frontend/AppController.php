<?php

namespace App\Http\Controllers\frontend;

use App\Models\App;
use App\Models\User;
use App\Models\Category;
use App\Models\AppVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function index($type) {
        $typeMapping = ['games' => 'game', 'apps' => 'app', 'tools' => 'tool'];
        $mappedType = $typeMapping[$type] ?? abort(404);
    
        $categories = Category::where('type', $mappedType)->get();
        abort_if($categories->isEmpty(), 404);
    
        $mainCategory = $categories->first();
    
        view()->share('seoData', [
            'title' => "{$mainCategory->type} - VH APK",
            'canonical' => url()->current(),
        ]);
    
        $items = App::with('developer')
                ->whereIn('category_id', $categories->pluck('id'))
                ->where('status', 'approved') 
                ->get();
    
        return view("frontend.$type.index", compact('items', 'categories') + [$type => $items]);
    }      

    public function show($id) {
        $app = App::with([
            'developer',
            'category',
            'versions',
            'reviews' => function ($query) {
                $query->whereNull('deleted_at');
            }
        ])->findOrFail($id);

        if ($app->status !== 'approved') {
            return redirect()->route('home')->with('error', 'Ứng dụng này chưa được phê duyệt.');
        }

        $latestVersion = $app->versions()->orderBy('created_at', 'DESC')->first();

        $screenshots = [];
        if ($latestVersion && $latestVersion->screenshots) {
            $screenshots = is_string($latestVersion->screenshots) 
                ? json_decode($latestVersion->screenshots, true) 
                : $latestVersion->screenshots;
        }
    
        $similarApps = $this->suggestSimilarApps($id);

        $userHasPurchased = null;
        $userReview = null;

        if (auth()->check()) {
            $userHasPurchased = auth()->user()->purchases()->where('app_id', $id)->exists();
            $userReview = $app->reviews->where('user_id', auth()->id())->first();
        }
    
        $seoData = [
            'title' => $app->name . ' - Ứng dụng',
            'canonical' => url('/apps/' . $id),
        ];
    
        return view('frontend.apps.details', compact('app', 'screenshots', 'userHasPurchased', 'userReview', 'similarApps', 'seoData'));
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
        ->where('status', 'approved') 
        ->where('name', 'LIKE', "%$keyword%")
        ->orWhere('description', 'LIKE', "%$keyword%")
        // ->orWhere('package_name', 'LIKE', "%$keyword%")
        ->orWhereHas('developer', fn($q) => $q->where('name', 'LIKE', "%$keyword%"))
        ->orWhereHas('category', fn($q) => $q->where('name', 'LIKE', "%$keyword%"))
        ->orderByRaw("LENGTH(name) - LENGTH(REPLACE(name, ?, '')) DESC", [$keyword])
        ->orderBy('total_downloads', 'desc') 
        ->orderBy('average_rating', 'desc') 
        ->take(25)
        ->get();

        return view('frontend.apps.list', compact('apps', 'keyword'));
    }

    public function loadMore(Request $request)
    {
        $keyword = $request->input('query');
        $offset = $request->input('offset', 0);

        $apps = App::where('status', 'approved')  
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%$keyword%")
                          ->orWhere('description', 'LIKE', "%$keyword%")
                          ->orWhereHas('developer', fn($q) => $q->where('name', 'LIKE', "%$keyword%"))
                          ->orWhereHas('category', fn($q) => $q->where('name', 'LIKE', "%$keyword%"));
                })
                ->orderBy('downloads', 'desc')
                ->skip($offset)  
                ->take(10)  
                ->get();

        return response()->json($apps);
    }

    public function suggestSimilarApps($appId)
    {
        $app = App::findOrFail($appId);

        $similarApps = App::where('id', '!=', $app->id)
            ->where('status', 'approved')
            ->where(function ($query) use ($app) {
                $query->where('category_id', $app->category_id)
                    ->orWhere('developer_id', $app->developer_id) 
                    ->orWhere('name', 'LIKE', '%' . $app->name . '%') 
                    ->orWhere('description', 'LIKE', '%' . $app->name . '%');
            })
            ->orderByDesc('total_downloads') 
            ->orderByDesc('average_rating') 
            ->limit(10)
            ->get();

        return $similarApps;
    }

    public function checkPackageName(Request $request)
    {
        $exists = App::where('package_name', $request->package_name)->exists();

        return response()->json(['exists' => $exists]);
    }
}
