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

                        <p>{{ __('messages.welcome') }}</p>
                        <p>@lang('messages.welcome') </p>

                        <p>{{ __('messages.name',['name' => 'Darshan']) }}</p>
                        <p>@lang('messages.name', ['name' => 'Yash'])</p>

                        {{ trans_choice('messages.comment',0) }} <br>
                        {{ trans_choice('messages.comment',1) }} <br>
                        {{ trans_choice('messages.comment',2) }}

                        <p>@lang('Home page')</p>

                        <p>@lang('Hello :name',['name' => 'Darshan'])</p>

                    @can('home.secret')
                        <p style="margin-bottom: 00px">
                            <a href="{{ route('secret') }}">
                                Go to Special content details
                            </a>
                        </p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
