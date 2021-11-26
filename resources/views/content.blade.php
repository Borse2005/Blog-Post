@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Post Content') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        {{--  {{ dd($post) }}  --}}
                        <span class="font-weight-bold">Title : </span>{{ $post->title }} <br>
                        <span class="font-weight-bold">Content : </span>{{ $post->content }} <br>

                        @if ($post->images)
                            <span class="font-weight-bold">Image : </span>  
                                <div style="background-image: url('{{ $post->images ->url() }}'); min-height: 500px;  color: white; text-align: center; ">
                                </div>

                            <br>
                        @else
                            <div class="pl-3">Image Not Found!</div>
                        @endif
                        
                        @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])

                        @endcomponent 
                        <br>


                        @component('components.updated', ['date' => $post->updated_at, ])
                            Updated
                        @endcomponent


                        @component('components.badge', ['show' => now()->diffInMinutes($post->created_at) < 5])
                            New Post !   
                        @endcomponent

                        @component('components.tags', ['tags' => $post->tags])
                                
                        @endcomponent

                        <div class="pl-3">
                            Currently read by {{ $counter }} people
                        </div>

                        <div class="form-group mb-0">
                            <form action="{{ route('post.comment.store',['post' => $post->id]) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" name="content" class="form-control @error('content') is-invalid @enderror mt-2 ml-3">
                                    </div>
                                    
                                    <div class="col-md-7">
                                        <input type="submit"  value="Add Comment" class="btn btn-success mt-2">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-danger mt-0 ml-3 font-weight-bold" >
                            @error('content')
                                {{ $message }}
                            @enderror
                        </div>
                        <div >
                            <div class="font-weight-bold">Comment : </div>
                            <div class="pl-3">
                                @forelse ($post->comment as $key=> $posts)
                                  {{ $posts->content }} <br>
                                  <span class="pl-3">

                                    @component('components.updated', ['date' => $posts->created_at,'name'=> $posts->user->name])
                                    @endcomponent

                                </span><br>
                                @empty
                                    <div>Comments not yet!</div>
                                @endforelse
                            </div>
                        </div>
                        <div>
                            @can('update', $post)
                                <a href="{{ route('post.edit',$post->id) }}" class="btn btn-success mt-3">Edit</a>
                            @endcan
                            @if (!$post->trashed())
                                @can('delete', $post)
                                    <form action="{{ route('post.destroy',$post->id) }}" method="post" class="btn">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" value="Delete" class=" btn btn-danger mt-3">
                                    </form>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('layouts._activity')
        </div>
    </div>
</div>
@endsection
