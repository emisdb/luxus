@extends('lux.layout.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __($header) }}</div>
                <pre>
                    @php
                        /**
                         * The $model passed from controller.
                         *
                         * @var array $model
                         */
                         var_dump($model);
                    @endphp
                    </pre>
                <div class="card-body">
                </div>
            </div>

        </div>
    </div>
@endsection
