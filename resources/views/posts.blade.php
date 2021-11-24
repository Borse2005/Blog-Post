@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

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
                               
                            @endcomponent
                            
                            <br>
                            
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
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('layouts._activity')
        </div>
    </div>
</div>
@endsection
