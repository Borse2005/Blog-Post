<?php

namespace App\Http\Controllers;

use App\Events\PostPosted;
use App\Http\Requests\Post as RequestsPost;
use App\Models\Image;
use App\Models\Post;
use App\Services\counter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public $counter;

    public function __construct(counter $counter)
    {
        // $this->middleware('auth');
        $this->conuter = $counter;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post =  Post::LatestWithRelation()->get();
        return view('posts', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsPost $request)
    {
        $validation = $request->validated();
        $validation['user_id'] = $request->user()->id;
        $post = Post::create($validation);

        event(new PostPosted($post));
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->images()->save(
                Image::make([
                    'path' => $path,
                ])
            );
        }

        $request->session()->flash('status', 'Post is Created!');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $posts = Cache::remember("blog-posts-{$id}", now()->addMinutes(10), function() use($id) {
            return Post::with('comment')
            ->with('user')
            ->with('tags')
            ->with('comment.user')
            ->with('comment.tags')
            ->Find($id);
        });

    //    $counter = resolve(counter::class);
        $post = $posts;

        return view('content', [
            'post' => $post, 
            'counter' => $this->conuter->increament("$id"),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($posts)
    {
        $post = Post::FindOrFail($posts);
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsPost $request,  $post)
    {
        
        $post = Post::FindOrFail($post);
        $this->authorize('update', $post);
        $validation = $request->validated();
        $post->fill($validation);
        
        if ($request->hasFile('thumbnail')) {
            
            $path = $request->file('thumbnail')->store('thumbnails');
            if($post->images){
                Storage::delete($post->images->path);
                $post->images->path = $path;
                $post->images->save();
            }else{
                $post->images()->save(
                    Image::make([
                        'path' => $path,
                    ])
                );
            }            
        }

        $post->save();

        $request->session()->flash('status', 'Post is updated!');
        return redirect()->route('post.show',$post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $post)
    {
        $posts = Post::FindOrFail($post);
        $this->authorize('delete', $posts);
        $posts->delete();
        session()->flash('status', 'Post is Deleted!');
        return redirect()->route('post.index');
    }
}
