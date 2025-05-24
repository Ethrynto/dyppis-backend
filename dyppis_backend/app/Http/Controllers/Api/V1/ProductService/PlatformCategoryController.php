<?php

namespace App\Http\Controllers\Api\V1\ProductService;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductService\CategoryResource;
use App\Models\ProductService\Category;
use App\Models\ProductService\Platform;
use App\Utils\ApiResponse;
use App\Utils\UuidHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PlatformCategoryController extends Controller
{

    public function index(Request $request, string $id)
    {
        $size = $request->input('size', 10);
        Cache::forget('platform/categories'); // Clear the cache before storing new data. TODO: Remove this line in production
        // Cache the platforms for 1 hour
        return CategoryResource::collection(Cache::remember('platform/categories', 3600, function () use ($size, $request, $id) {
            $result = Category::query();

            $platforms = (array) [$id];
            $result->whereHas('platforms', function ($query) use ($platforms) {
                $query->whereIn('platforms.id', $platforms);
            });

            return $result->paginate($size);
        }));
    }


    /**
     *  Add categories to a platform
     */
    public function store(Request $request, string $platformId): \Illuminate\Http\JsonResponse
    {
        $fieldType = UuidHelper::isUuid($platformId) ? 'id' : 'slug';
        $request->validate([
            'categories' => ['nullable', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
        ]);

        try {
            $platform = Platform::where($fieldType, $platformId)->firstOrFail();
            DB::transaction(function () use ($platform, $request) {
                $data = array_map(fn($category) => [
                    'platform_id' => $platform->id,
                    'category_id' => $category,
                ], $request->get('categories', []));
                DB::table('categories_platforms')->insert($data);
            });

            return ApiResponse::created([]);
        } catch (\Exception $exception) {
            throw new NotFoundException(['code' => 404, 'details' => 'Platform not found']);
        }
    }

    /**
     *  Remove categories from a platform
     */
    public function destroy(Request $request, string $platformId): \Illuminate\Http\JsonResponse
    {
        $fieldType = UuidHelper::isUuid($platformId) ? 'id' : 'slug';
        $request->validate([
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
        ]);

        try {
            $platform = Platform::where($fieldType, $platformId)->firstOrFail();
            DB::transaction(function () use ($platform, $request) {
                DB::table('categories_platforms')
                    ->where('platform_id', $platform->id)
                    ->whereIn('category_id', $request->get('categories', []))
                    ->delete();
            });

            return ApiResponse::deleted();
        } catch (\Exception $exception) {
            throw new NotFoundException(['code' => 404, 'details' => 'Platform not found']);
        }
    }
}
