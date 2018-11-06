<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>any.ideas</title>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('/css/App.css') }}">
    </head>
    <body>
        @if(auth()->check())
        <script>
            window.checkAuth = {!! auth()->user()  !!}
        </script>
        @endif

        <div id="app">
            <app />
        </div>
        
        @include ('footer')
        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>