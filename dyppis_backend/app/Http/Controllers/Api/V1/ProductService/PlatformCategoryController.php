<?php

namespace App\Http\Controllers\Api\V1\ProductService;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductService\PlatformCategoryResource;
use App\Models\ProductService\PlatformCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PlatformCategoryController extends Controller
{
    /*
     *  Get the platform categories
     */
    public function index()
    {
        return PlatformCategoryResource::collection(Cache::remember('platform_categories', 60*60*24*365, function () {
            return PlatformCategory::all();
        }));
    }
}
