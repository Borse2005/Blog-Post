<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($tag){
        $tag = Tags::FindOrFail($tag);
         return view('post', [
             'post' => $tag->post,
             'comment' => [],
             'active' => [],
             'user'=> []
        ]);
    }
}
