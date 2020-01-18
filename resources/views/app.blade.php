<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ config('app.direction') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

        <title>Theory Test</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
       <div id="app">
           <testly-header></testly-header>

           <router-view :key="$route.fullPath" class="container tw-pb-8 md:tw-pb-10"></router-view>

           <testly-footer></testly-footer>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
