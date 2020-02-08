<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('app.direction') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <title>טסטלי</title>

        <link rel="icon" href="{{ URL::asset('/assets/icon.png') }}" type="image/x-icon"/>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <div id="app">
           <testly-app></testly-app>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
