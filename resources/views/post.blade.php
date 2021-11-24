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

                    @forelse ($post as  $posts)
                    {{-- {{ dd($posts) }} --}}
                        <div>
                            @if ($posts->trashed())
                                <del class="text->muted">   
                            @endif
                                <a href="{{ route('post.show',$posts->id) }}" class="text-decoration-none {{ $posts->trashed() ? 'text-muted' : "" }}" >
                                    <span class="text-dark">{{ $posts->id }}. </span> {{ $posts->title }}
                                </a>
                            @if ($posts->trashed())
                                </del>          
                            @endif
                            <br>
                            
                            @component('components.updated', ['date' => $posts->created_at, 'name' => $posts->user->name])
                               
                            @endcomponent <br>
                            
                            @component('components.tags', ['tags' => $posts->tags])
                                
                            @endcomponent

                            @if ($posts->comment_count)
                               <span class="font-weight-bold pl-3">{{ $posts->comment_count }}. </span>Comments
                            @else
                                <span class="pl-3">Comments not yet!</span>
                            @endif
                        </div>
                    @empty
                        <div>Post not yet!</div>
                    @endforelse

                     {{-- <div class="mt-3 mb-0">{{ $post->links() }}</div>  --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                {{--  <div class="card-body">
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
                </ul>  --}}
                @component('components.card',['title' => 'Most Commented Post'])
                    @slot('subtitle')
                        What people are currently talking about
                    @endslot
                    @slot('items')
                        @forelse ($comment as $comments)
                            <li class="list-group-item">
                                <a href="{{ route('post.show',$comments->id) }}">{{ $comments->title }}</a>
                            </li>
                        @empty
                            <div class="list-group-item">Comments not yet!</div>
                        @endforelse 
                    @endslot
                @endcomponent
            </div>
            <div class="card mt-4" style="width: 18rem;">
                {{--  <div class="card-body">
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
                    
                    
                </ul>  --}}
                @component('components.card',['title' => 'Most Posted User'])
                    @slot('subtitle')
                        Users with most posts written
                    @endslot
                    @slot('items', collect($user)->pluck('name'))
                    @slot('else')
                        User not found!
                    @endslot
                @endcomponent
            </div>
            <div class="card mt-4" style="width: 18rem;">
                {{--  <div class="card-body">
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
            </div>  --}}

            @component('components.card', ['title' => 'Most Active User'])
                @slot('subtitle')
                    Last month active user
                @endslot
                @slot('items', collect($active)->pluck('name'))
                @slot('else')
                    Last month active user not found!
                @endslot
            @endcomponent
        </div>
    </div>
</div>
@endsection
