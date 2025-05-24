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
        return PlatformResource::collection(Cache::remember('platforms', 3600, function () use ($request, $size) {

            $query = Platform::query();

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


    /**
     *  Update the platform
     */
    public function update(UpdatePlatformRequest $request, string $id): JsonResource
    {
        $fieldType = 'slug';
        if (UuidHelper::isUuid($id))
            $fieldType = 'id';

        $platform = Platform::where($fieldType, $id)->firstOrFail();

        // TODO: not work the update logo
        if ($request->hasFile('logo'))
            $logo = MediafileController::load($request->file('logo'), 'platform');
        if ($request->hasFile('banner'))
            $banner = MediafileController::load($request->file('banner'), 'banner');

        if(isset($logo))
            $platform->logo_id = $logo->getData()->data->id ?? null;

        if(isset($banner))
            $platform->banner_id = $banner->getData()->data->id ?? null;

        if($request->has('slug'))
            $platform->slug = $request->get('slug');

        if($request->has('title'))
            $platform->title = $request->get('title');

        if($request->has('parent_id'))
            $platform->parent_id = $request->get('parent_id');

        if($request->has('category_id'))
            $platform->category_id = $request->get('category_id');

        if($request->has('sales'))
            $platform->sales = $request->get('sales');

        if($request->has('views'))
            $platform->views = $request->get('views');

        $platform->save();
        return new PlatformResource($platform);
    }


    /**
     *  Delete the platform
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
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
}
