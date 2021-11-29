<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    public static function boot(){

        parent::boot();

        // static::creating(function(Tag $tag){
        //     Cache::forget("tag-cahce-{$tag}");
        // });

        static::updating(function(Tag $tag){
            Cache::forget("tag-cahce-{$tag}");
        });

        static::deleting(function(Tag $tag){
            Cache::forget("tag-cahce-{$tag}");
        });
    }
}
