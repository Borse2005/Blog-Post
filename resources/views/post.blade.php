@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="text-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @forelse ($post as $posts)
                        <div>
                            @if ($posts->trashed())
                                <del>   
                            @endif
                                <a href="{{ route('post.show',$posts->id) }}" class="text-decoration-none {{ $posts->trashed() ? 'text-muted' : "" }}" >
                                    {{ $posts->title }}
                                </a>
                            @if ($posts->trashed())
                                </del>          
                            @endif
                            <br>
                            <span class="pl-3">
                               Added  {{ $posts->created_at->diffForHumans() }} by 
                                {{ $posts->user->name }}
                            </span><br>
                            @if ($posts->comment_count)
                               <span class="font-weight-bold pl-3">{{ $posts->comment_count }}. </span>Comments
                            @else
                                <span class="pl-3">Comments not yet!</span>
                            @endif
                        </div>
                    @empty
                        <div>Post not yet!</div>
                    @endforelse

                    {{--  <div class="mt-3 mb-0">{{ $post->links() }}</div>  --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Most Commented Post</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        What people are currently talking about
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($comment as $comments)
                        <li class="list-group-item">
                            <a href="{{ route('post.show',$comments->id) }}">{{ $comments->title }}</a>
                        </li>
                    @empty
                        <div class="list-group-item">Comments not yet!</div>
                    @endforelse                  
                </ul>
            </div>
            <div class="card mt-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        Most Posted User
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Users with most posts written
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($user as $users)
                        <li class="list-group-item">
                            {{ $users->name }}
                        </li>
                    @empty
                        <div class="list-group-item">User not active!</div>
                    @endforelse                  
                </ul>
            </div>
            <div class="card mt-4" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        Most Active User 
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Last month active user
                    </h6>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($active as $active)
                        <li class="list-group-item">
                            {{ $active->name }}
                        </li>
                    @empty
                        <div class="list-group-item">User not active!</div>
                    @endforelse                  
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
