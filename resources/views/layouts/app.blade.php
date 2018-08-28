<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>any.ideas</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        @auth
            user logged in
        @else
            guest user
        @endauth
        <div id="app">
            <app :user-data='{!! json_encode($userData) !!}'></app> <!-- vue here m8 -->
        </div>
        @include ('footer')
        <script src="{{ mix('js/App.js') }}"></script>
    </body>
</html>