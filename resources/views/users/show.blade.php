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
                        </div>
                        <div class="col-8">
                            <div>
                                <span class="font-weight-bold">
                                    Name: 
                                </span>
                                {{ $user->name }}
                            </div>
                            <div>
                                <span class="font-weight-bold">
                                    Email: 
                                </span>
                                {{ $user->email }}
                            </div>
                            <div>
                                <span class="font-weight-bold">
                                    Role: 
                                </span>
                                @if ($user->is_admin == 0)
                                    {{ __('Normal') }}
                                @else
                                    {{ __('Admin') }}
                                @endif
                            </div>

                            @can('user.update', $user->id)
                            <div>
                                <a href="{{ route('user.edit',$user->id) }}" class="btn btn-success mt-3">Update</a>
                            </div>
                                
                            @endcan
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection