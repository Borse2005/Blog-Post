<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable =[
        'tags_id'
    ];

    public function post(){
        return $this->morphedByMany(Post::class, 'taggable');
    }
    public function comment(){
        return $this->morphedByMany(Post::class, 'taggable');
    }
}
