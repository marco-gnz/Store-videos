<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Resources\FileResource;
use Aws\S3\PostObjectV4;
use Illuminate\Support\Facades\Storage;

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

    public function store(Request $request)
    {
        //firstOrCreate= función para crear datos, si el dato ya existe en bd no lo vuelve a crear o duplicar. 
        //firstOrCreate= (['verifica si existe', 'si no existe el dato se crea'])
        $file = $request->user()->files()->firstOrCreate($request->only('path'), $request->only('name', 'size'));
        return new FileResource($file);

    }

    public function destroy(Request $request, File $file)
    {
        $this->authorize('destroy', $file);

        $file->delete();
    }

    public function signedURL(Request $request)
    {
        $filename = md5($request->name . microtime()) . '.' . $request->extension;
        $userId = $request->user()->id;

        $object = new PostObjectV4(
            Storage::disk('s3')->getAdapter()->getClient(),
            config('filesystems.disks.s3.bucket'),
            ['key' => "files/$userId/$filename"],
            [
                ['bucket' => config('filesystems.disks.s3.bucket')],
                ['starts-with', '$key', "files/$userId"]
            ]
        );
        return response()->json([
            'attributes' => $object->getFormAttributes(),
            'additionalData' => $object->getFormInputs()
        ]);
    }
    
}
