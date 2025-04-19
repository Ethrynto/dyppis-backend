<?php

namespace App\Http\Controllers\Api\V1\MediaService;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaService\StoreMediafileRequest;
use App\Models\MediaService\Mediafile;
use App\Models\MediaService\MediafileCategory;
use Illuminate\Support\Str;

class MediafileController extends Controller
{
    public function store(StoreMediafileRequest $request)
    {
        $file = $request->file('file');
        $mediafileCategory = MediafileCategory::where('id', $request->input('category_id'))->firstOrFail();
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($mediafileCategory->path, $fileName, 'public');

        $mediafile = Mediafile::create([
            'id' => (string) Str::uuid(),
            'file_name' => $fileName,
            'file_path' => $filePath,
            'category_id' => $request->input('category_id'),
        ]);

        return response()->json(['id' => $mediafile->id], 201);
    }
}
