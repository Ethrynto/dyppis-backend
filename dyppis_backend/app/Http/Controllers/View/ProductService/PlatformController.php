<?php

namespace App\Http\Controllers\View\ProductService;

use App\Http\Controllers\Controller;
use App\Models\MediaService\MediafileCategory;
use App\Models\ProductService\Platform;
use App\Models\ProductService\PlatformCategory;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    //
    public function index(Request $request)
    {
        // Default parameters for sorting and pagination
        $sortBy = $request->query('sortBy', 'title');
        $orderBy = $request->query('orderBy', 'asc');
        $size = $request->query('size', 10);

        $platforms = Platform::orderBy($sortBy, $orderBy)->paginate($size);

        $logoCategory = MediafileCategory::where('slug', 'platform')->pluck('url')->first();
        //return response()->json($platforms, 200);

        return view('admin.platforms.index', compact('platforms', 'sortBy', 'orderBy', 'size', 'logoCategory'));
    }

    public function create()
    {
        $platforms = Platform::orderBy('title', 'asc')->pluck('id', 'title');
        $platformCategories = PlatformCategory::orderBy('title', 'asc')->pluck('id', 'title');
        //return response()->json($platformCategories);
        return view('admin.platforms.create', compact('platforms', 'platformCategories'));
    }
}
