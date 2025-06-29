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
        Cache::forget('products'); // Clear the cache before storing new data. TODO: Remove this line in production
        return ProductResource::collection(Cache::remember('products', 3600, function () use ($size, $request) {
//            $query = Product::query();
//
//            if ($request->has('sortBy')) {
//                $orderBy = $request->get('orderBy', 'desc');
//                if($orderBy != 'asc' && $orderBy != 'desc') {
//                    $orderBy = 'desc';
//                }
//                $query->orderBy($request->input('sortBy'), $orderBy);
//            }
//
//            return $query->paginate($size);
            return ProductFilterController::filterProducts($request, $size);
        }));
    }
}
