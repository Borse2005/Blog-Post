@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ $user->images ? Storage::disk('local')->url($user->images->path) : '' }}" class="img-thumbnail avatar" />
                            @can('user.update', $user->id)
                                <div class="ml-4">
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success mt-3">Update</a>
                                </div>                                
                            @endcan
                        </div>
                        <div class="col-8">
                            <div class="ml-3">
                                <span class="font-weight-bold">
                                    Name: 
                                </span>
                                {{ $user->name }}
                            </div>
                            <div class="ml-3">
                                <span class="font-weight-bold">
                                    Email: 
                                </span>
                                {{ $user->email }}
                            </div>
                            <div class="ml-3">
                                <span class="font-weight-bold">
                                    Role: 
                                </span>
                                @if ($user->is_admin == 0)
                                    {{ __('Normal') }}
                                @else
                                    {{ __('Admin') }}
                                @endif
                            </div>

                            @component('components.comments', ['post' => 'user.comment.store', 'id' => $user->id])
                            @endcomponent <br>
                            <div class="font-weight-bold">Comments :</div>
                            @forelse ($user->commentOn as $key => $users)
                                <div class="ml-2">
                                   <span class="font-weight-bold">{{ $key }}</span> . {{ $users->content }}
                                         <div>Created by {{ $users->created_at->diffForHumans() }} by  {{ $users->user->name }} 
                                    </div>
                                </div>
                            @empty
                                <div class="ml-3">
                                    Comment not yet!
                                </div>
                            @endforelse
                                
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection