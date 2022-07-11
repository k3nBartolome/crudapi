<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
    <title>Crud</title>
</head>

<body>
    <main id="app">
        @yield('content')
    </main>

    <script src="{{ mix('js/app.js') }}"></script>
    @stack('custom-scripts')
</body>
</html>