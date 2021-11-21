@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                        <span class="font-weight-bold">Title : </span>{{ $post->title }} <br>
                        <span class="font-weight-bold">Content : </span>{{ $post->content }} <br>
                        <span class="font-weight-bold">Time : </span>{{ $post->created_at->diffForHumans() }}<br>
                        <span class="font-weight-bold">Creater : </span>{{ $post->user->name }}<br>
                        <div >
                            <div class="font-weight-bold">Comment : </div>
                            <div class="pl-3">
                                @forelse ($post->comment as $key=> $posts)
                                  {{ $posts->content }} <br>
                                  <span class="pl-3">
                                      Added   {{ $posts->created_at->diffForHumans() }}
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
                            <a href="{{ route('index',$post->id) }}" class="btn btn-success mt-3">Comment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
