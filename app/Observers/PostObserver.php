<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function deleting(Post $post){
        $post->comment()->delete();
        Cache::forget("blog-posts-{$post->id}");
    }

    public function updating(Post $post){
        Cache::forget("blog-posts-{$post->id}");
    }

    public function restoring(Post $post){
        $post->comments->restored();
    }
}
