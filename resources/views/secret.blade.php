@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Secret') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Secret page') }}
                    <p class="mb-0">This is a secret email secret@laravel.com</p>
                    <p>Mail Secret</p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
