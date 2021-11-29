@component('mail::message')
Comment was posted on your blog post

Hi {{ $comment->commentable->user->name }}

Someone has commented on your  post
@component('mail::button', ['url' => route('post.show',$comment->commentable->id)])
View your post!
@endcomponent

@component('mail::button', ['url' => route('user.show',$comment->user->id)])
Visit  {{ $comment->user->name }} Profile
@endcomponent

@component('mail::panel')
    {{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
