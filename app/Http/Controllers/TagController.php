<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;

class TagController extends Controller
{
    public function index($tag){
        $tags = Cache::remember("tag-cahce-{$tag}", now()->addMinutes(10), function() use($tag) {
            return  Tag::FindOrFail($tag);
        });

        $post =  Cache::remember('post-id', now()->addMinutes(10), function() use($tags) {
            return $tags->post()->latestWithRelation()->get();
        });        
        
         return view('posts',compact('post'));
    }
}
