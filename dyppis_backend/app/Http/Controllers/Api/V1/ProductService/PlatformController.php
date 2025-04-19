<?php

namespace App\Http\Controllers\Api\V1\ProductService;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductService\StorePlatformRequest;
use App\Http\Resources\ProductService\PlatformResource;
use App\Models\ProductService\Platform;
use App\Utils\UuidHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class PlatformController extends Controller
{
    /**
     *  Get the all platforms
     */
    public function index(Request $request): JsonResource
    {
        $pagePerPage = $request->input('perPage', 10);
        Cache::forget('platforms'); // Clear the cache before storing new data. TODO: Remove this line in production
        // Cache the platforms for 1 hour
        return PlatformResource::collection(Cache::remember('platforms', 3600, function () {
            return Platform::paginate(10);
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


    }
}
