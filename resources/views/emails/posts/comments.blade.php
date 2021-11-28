<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<p>
    Hi {{ $comment->commentable->user->name }}
</p>

<p>
    Someone has commented on your  post
    <a href="{{ route('post.show',$comment->commentable->id) }}">
        {{ $comment->commentable->title }}
    </a>
</p>

<hr>

<p>
    <img src="{{ $message->embed(Storage::disk('public')->path($comment->user->images->path)) }}" alt="">
    <a href="{{ route('user.show',$comment->user->id) }}">
        {{ $comment->user->name }}
    </a>
</p>

<p>
    "{{ $comment->content }}"
</p>