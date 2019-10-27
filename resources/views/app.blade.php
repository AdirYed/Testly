<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Theory Test</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        @include('nav-bar')

        <div id="app" class="tw-container">
            <router-view></router-view>
        </div>

        <div style="margin-bottom: 3000px"></div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
