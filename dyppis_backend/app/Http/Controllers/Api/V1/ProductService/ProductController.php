<?php

namespace App\Http\Controllers\Api\V1\ProductService;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductService\ProductResource;
use App\Models\ProductService\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $size = $request->input('size', 30);
        return ProductResource::collection(Cache::remember('products', 3600, function () use ($size) {
            return Product::paginate($size);
        }));
    }
}
