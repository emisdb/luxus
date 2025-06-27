@extends('lux.layout.admin')

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
                    <div id="app">
                        <router-view></router-view>
                    </div>
                    {{ __('You are logged in on this page !') }}
                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    import ExampleComponent from "../../js/components/hic/ExampleComponent";

    export default {
        components: {ExampleComponent}
    }
</script>
