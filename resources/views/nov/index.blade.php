@extends('nov.layout.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="card">
                <div class="card-header">{{ __($header) }}</div>
               <div class="card-body">
                        <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
@endsection
