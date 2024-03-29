@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (auth()->check())
                        {{ __('You are logged in!') }}
                    @else
                        {{ __('You are logged out!') }}
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
