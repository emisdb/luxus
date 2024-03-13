@extends('lux.layout.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __($header) }}</div>

                <div class="card-body">
                    <div id="app">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
