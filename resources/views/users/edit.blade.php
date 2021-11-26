@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{ route('user.update',['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-4">
                                <img src="{{ $user->images ? Storage::disk('local')->url($user->images->path) : '' }}" class="img-thumbnail avatar" />

                                <div class="card mt-4">
                                    <div class="card-body " style="padding: 10px">
                                        <h6>Upload a different photo</h6>
                                        <input class="form-control-file" type="file" name="avatar" />
                                    </div>
                                </div>
                                @error('avatar')
                                    <div class="text-danger font-weight-bold mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input class="form-control" value="" type="text" name="name" />
                                </div>
                                @error('name')
                                    <div >
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Save Changes" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
