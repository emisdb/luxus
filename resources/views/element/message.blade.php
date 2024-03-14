@extends('element.layouts.app')
@section('content')
    <div>
        <el-button>@{{ message }}</el-button>
        <el-button>I am ElButton</el-button>
    </div>
@endsection
@push('scripts')
    <script>
        const App = {
            data() {
                return {
                    message: "Hello Element Plus",
                };
            },
        };
        const app = Vue.createApp(App);
        app.use(ElementPlus);
        app.mount("#app");
    </script>
@endpush
