<?php

namespace App\Http\Controllers;

use App\Http\Resources\MediaService\MediafileResource;
use App\Models\MediaService\Mediafile;
use Illuminate\Http\Request;

class MediafileController extends Controller
{
    //
    public function index()
    {
        return MediafileResource::collection(Mediafile::all());
    }
}
