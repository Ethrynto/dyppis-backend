<?php

namespace App\Http\Controllers\Api\V1\ProductService;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Api\V1\MediaService\MediafileController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductService\StorePlatformRequest;
use App\Http\Requests\ProductService\UpdatePlatformRequest;
use App\Http\Resources\ProductService\PlatformResource;
use App\Models\ProductService\Platform;
use App\Utils\ApiResponse;
use App\Utils\UuidHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PlatformController extends Controller
{
    /**
     *  Get the all platforms
     */
    public function index(Request $request): JsonResource
    {
        $size = $request->input('size', 10);
        Cache::forget('platforms'); // Clear the cache before storing new data. TODO: Remove this line in production
        // Cache the platforms for 1 hour
        return PlatformResource::collection(Cache::remember('platforms', 3600, function () use ($size) {
            return Platform::paginate($size);
        }));
    }


    /**
     *  Get the platform by id/slug
     */
    public function show(string $id): JsonResource
    {
        $fieldType = 'slug';
        if (UuidHelper::isUuid($id))
            $fieldType = 'id';

        Cache::forget("platforms/{$id}"); // Clear the cache before storing new data. TODO: Remove this line in production
        $platform = Platform::where($fieldType, $id)->firstOrFail();
        return PlatformResource::make(Cache::remember("platforms/{$id}", 3600, function () use ($platform) {
            return $platform;
        }));
    }


    /**
     *  Save the platform
     */
    public function store(StorePlatformRequest $request): JsonResource
    {
        if (/*Auth::check() && Auth::user()->role == 'administrator'*/ true) // TODO: correct this line in production
        {
            if ($request->hasFile('logo'))
                $logo = MediafileController::load($request->file('logo'), 'platform');
            if ($request->hasFile('banner'))
                $banner = MediafileController::load($request->file('banner'), 'banner');

            $platformInfo = [
                'id' => UuidHelper::generateUuid(),
                'slug' => $request->get('slug'),
                'title' => $request->get('title'),
                'parent_id' => $request->get('parent_id'),
                'category_id' => $request->get('category_id'),
                'sales' => $request->get('sales'),
                'views' => $request->get('views'),
            ];
            if(isset($logo))
                $platformInfo['logo_id'] = $logo->getData()->data->id ?? null;

            if(isset($banner))
                $platformInfo['banner_id'] = $banner->getData()->data->id ?? null;

            $platform = Platform::create($platformInfo);
            return new PlatformResource($platform);
        }
        else
            throw new UnauthorizedException([]);
    }


    /**
     *  Update the platform
     */
    public function update(UpdatePlatformRequest $request, string $id): JsonResource
    {
        if (/*Auth::check() && Auth::user()->role == 'administrator'*/ true) // TODO: correct this line in production
        {
            $platform = Platform::where('id', $id)->firstOrFail();

            if ($request->hasFile('logo'))
                $logo = MediafileController::load($request->file('logo'), 'platform');
            if ($request->hasFile('banner'))
                $banner = MediafileController::load($request->file('banner'), 'banner');

            $platformInfo = [
                'slug' => $request->get('slug'),
                'title' => $request->get('title'),
                'parent_id' => $request->get('parent_id'),
                'category_id' => $request->get('category_id'),
                'sales' => $request->get('sales'),
                'views' => $request->get('views'),
            ];
            if(isset($logo))
                $platformInfo['logo_id'] = $logo->getData()->data->id ?? null;

            if(isset($banner))
                $platformInfo['banner_id'] = $banner->getData()->data->id ?? null;

            $platform->update($platformInfo);
            return new PlatformResource($platform);
        }
        else
            throw new UnauthorizedException([]);
    }


    /**
     *  Delete the platform
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        if (/* Auth::check() && Auth::user()->role == 'administrator'*/ true) // TODO: correct this line in production
        {
            $searchField = 'slug';
            if(UuidHelper::isUuid($id))
                $searchField = 'id';

            try {
                $platform = Platform::where($searchField, $id)
                    ->first();

                Platform::where($searchField, $id)
                    ->delete();

                if($platform->logo_id !== null) MediafileController::remove($platform->logo_id);
                if($platform->banner_id !== null) MediafileController::remove($platform->banner_id);
                return ApiResponse::deleted();
            }  catch (\Exception $exception)
            {
                throw new NotFoundException(['code' => 404, 'details' => 'Not Found']);
            }
        }
        else
            throw new UnauthorizedException([]);
    }


    public function addCategories(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $fieldType = 'slug';
        if (UuidHelper::isUuid($id))
            $fieldType = 'id';

        $request->validate([
            'categories' => ['nullable', 'array'],
        ]);
        try {
            $platformId = $id;
            if ($fieldType == 'slug')
                $platformId = Platform::where('slug', $id)->first()->id;

            $data = [];
            foreach ($request->get('categories') as $category)
            {
                $data[] = [
                    'platform_id' => $platformId,
                    'category_id' => $category
                ];
            }

            DB::table('categories_platforms')->insert($data);
            return ApiResponse::created([]);
        }
        catch (\Exception $exception)
        {
            throw new NotFoundException(['code' => 404, 'details' => 'Not Found', 'message' => $exception->getMessage()]);
        }
    }
}
