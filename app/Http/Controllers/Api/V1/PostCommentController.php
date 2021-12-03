<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\PostCommented;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment;
use App\Http\Resources\Comment as ResourcesComment;
use App\Models\Comment as ModelsComment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, Request $request)
    {
        $this->authorize(ModelsComment::class);
        // return response()->json(['comment' => []]);
        $perPage = (int) $request->input('per_page') ?? 5;
        return  ResourcesComment::collection(
            ($post->comment()->with('user')->paginate($perPage )->appends(
                [
                    'per_page' => $perPage,
                ]
            ))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post,Comment $request)
    {
        $comment = $post->comment()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        event(new PostCommented($comment));

        return new ResourcesComment($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, ModelsComment $comment)
    {
        return new ResourcesComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, ModelsComment $comment, Comment $request)
    {
        $this->authorize($comment);
        $comment->content = $request->input(['content']);
        $comment->save();

        return new ResourcesComment($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, ModelsComment $comment)
    {
        $this->authorize($comment);
        $comment->delete();

        return response()->noContent();
    }
}
