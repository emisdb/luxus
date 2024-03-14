<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <script
        src="https://unpkg.com/vue@3/dist/vue.global.js">
    </script>     <!-- import CSS -->
    <link rel="stylesheet" href="https://unpkg.com/element-plus/dist/index.css">
    <!-- import JavaScript -->
    <script src="https://unpkg.com/element-plus"></script>
    <title>Element Plus demo</title>
</head>
<body>
<div id="app">
    @yield('content')
</div>
@stack('scripts')
</body>
</html>
