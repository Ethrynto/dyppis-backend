<?php

namespace App\Http\Controllers\Api\V1\ProductService;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Api\V1\MediaService\MediafileController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductService\StoreCategoryRequest;
use App\Http\Requests\ProductService\StorePlatformRequest;
use App\Http\Requests\ProductService\UpdateCategoryRequest;
use App\Http\Requests\ProductService\UpdatePlatformRequest;
use App\Http\Resources\ProductService\CategoryResource;
use App\Http\Resources\ProductService\PlatformResource;
use App\Models\ProductService\Category;
use App\Models\ProductService\Platform;
use App\Utils\ApiResponse;
use App\Utils\UuidHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     *  Get the all categories
     */
    public function index(Request $request): JsonResource
    {
        $size = $request->input('size', 10);
        Cache::forget('categories'); // Clear the cache before storing new data. TODO: Remove this line in production
        // Cache the platforms for 1 hour
        return CategoryResource::collection(Cache::remember('categories', 3600, function () use ($size, $request) {
            $query = Category::query();

            if ($request->has('platforms')) {
                $platforms = (array) $request->input('platforms');
                $query->whereHas('platforms', function ($query) use ($platforms) {
                    $query->whereIn('platforms.id', $platforms);
                });
            }


            if ($request->has('sortBy')) {
                $orderBy = $request->get('orderBy', 'desc');
                if($orderBy != 'asc' && $orderBy != 'desc') {
                    $orderBy = 'desc';
                }
                $query->orderBy($request->input('sortBy'), $orderBy);
            }

            return $query->paginate($size);
        }));
    }


    /**
     *  Get the category by id/slug
     */
    public function show(string $id): JsonResource
    {
        $fieldType = 'slug';
        if (UuidHelper::isUuid($id))
            $fieldType = 'id';

        Cache::forget("categories/{$id}"); // Clear the cache before storing new data. TODO: Remove this line in production
        $category = Category::where($fieldType, $id)->firstOrFail();
        return CategoryResource::make(Cache::remember("categories/{$id}", 3600, function () use ($category) {
            return $category;
        }));
    }


    /**
     *  Save the category
     */
    public function store(StoreCategoryRequest $request): JsonResource
    {
        if ($request->hasFile('logo'))
            $logo = MediafileController::load($request->file('logo'), 'icon');

        $categoryInfo = [
            'id' => UuidHelper::generateUuid(),
            'slug' => $request->get('slug'),
            'title' => $request->get('title'),
            'is_public' => $request->get('is_public', false),
        ];
        if(isset($logo))
            $categoryInfo['logo_id'] = $logo->getData()->data->id ?? null;

        $category = Category::create($categoryInfo);
        return new CategoryResource($category);
    }


    /**
     *  Update the category
     */
    public function update(UpdateCategoryRequest $request, string $id): JsonResource
    {
        $fieldType = 'slug';
        if (UuidHelper::isUuid($id))
            $fieldType = 'id';

        $category = Category::where($fieldType, $id)->firstOrFail();

        // TODO: not work the update logo
        if ($request->hasFile('logo'))
            $logo = MediafileController::load($request->file('logo'), 'icon');

        if(isset($logo))
            $category->logo_id = $logo->getData()->data->id ?? null;

        if($request->has('slug'))
            $category->slug = $request->get('slug');

        if($request->has('title'))
            $category->title = $request->get('title');

        if($request->has('is_public'))
            $category->is_public = $request->get('is_public');

        $category->save();
        return new CategoryResource($category);
    }

    /**
     *  Delete the category
     *
     *  @throws NotFoundException
     */
    public function destroy(string $id): JsonResponse
    {
        $searchField = 'slug';
        if(UuidHelper::isUuid($id))
            $searchField = 'id';

        try {
            $category = Category::where($searchField, $id)
                ->first();

            Category::where($searchField, $id)
                ->delete();

            if($category->logo_id !== null) MediafileController::remove($category->logo_id);
            return ApiResponse::deleted();
        }  catch (\Exception $exception)
        {
            throw new NotFoundException(['code' => 404, 'details' => 'Not Found']);
        }
    }
}
