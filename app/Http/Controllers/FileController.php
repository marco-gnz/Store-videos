<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Resources\FileResource;

class FileController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        return FileResource::collection($request->user()->files);

    }
}
