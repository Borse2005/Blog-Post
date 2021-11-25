<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'post_id'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function url(){
        return Storage::disk('local')->url($this->path);
    }
}
