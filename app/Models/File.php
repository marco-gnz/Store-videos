<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'path',
        'size'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
