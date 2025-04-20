<?php

namespace App\Http\Controllers\Api\V1\MediaService;

use App\Http\Controllers\Controller;
use App\Models\MediaService\Mediafile;
use App\Models\MediaService\MediafileCategory;
use App\Utils\ApiResponse;
use App\Utils\UuidHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MediafileController extends Controller
{
    /**
     *  This method is used to load a picture file into the storage.
     *
     *  @param mixed $imageFile Picture file
     *  @param string|null $categoryId The category id or slug for load picture
     *  @return mixed
     *  @throws BadRequestException
     */
    public static function load(mixed $imageFile, string|null $categoryId = null): mixed
    {
        $category = null;
        if (UuidHelper::isUuid($categoryId) && $categoryId !== null)
            $category = MediafileCategory::findOrFail($categoryId);
        else
            $category = MediafileCategory::where('slug', $categoryId ?? 'product')
                ->firstOrFail();

        $fileInfo = [
            'id' => (string) Str::uuid(),
            'file_name' => Str::uuid() . '.' . $imageFile->getClientOriginalExtension(),
            'file_type' => $imageFile->getMimeType(),
            'file_size' => $imageFile->getSize(),
            'category_id' => $category->id,
            'created_at' => now(),
        ];

        try {
            Storage::disk('public')->putFileAs($category->path, $imageFile, $fileInfo['file_name']);
            Mediafile::insert($fileInfo);
            return ApiResponse::created($fileInfo);
        }
        catch (\Exception $e) {
            $errorInfo = [
                'details' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
            throw new BadRequestException($errorInfo);
        }
    }

    /**
     *  Remove the specified resource from storage.
     *
     *  @param string $id
     *  @return JsonResponse
     */
    public static function remove(string $id): JsonResponse
    {
        $fileInfo = Mediafile::where('id', $id)
            ->first(['file_name', 'category_id']);
        $categoryPath = MediafileCategory::where('id', $fileInfo->category_id)
            ->pluck('path')
            ->first();
        Storage::disk('public')->delete($categoryPath . '/' . $fileInfo->file_name);
        Mediafile::destroy($id);

        return ApiResponse::deleted();
    }
}
