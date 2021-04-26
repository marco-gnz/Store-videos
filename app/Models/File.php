<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $fillable = [ 'uuid', 'name', 'path', 'size' ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function booted()
    {
        //funcion estatica para que al crear un archivo se generará un uuid al archivo.
        static::creating(function ($file) {
            $file->uuid = Str::uuid();
        });

        //al eliminar un file en el controlador ($file->delete();), se pasa a esta función estática para eliminarlo de s3.
        static::deleted(function ($file) {
            Storage::disk('s3')->delete($file->path);
        });
    }

}
