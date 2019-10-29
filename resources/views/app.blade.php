<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Theory Test</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
       <div id="app">
            <theory-nav-bar>
                <template slot="left-bar">
                    <theory-bar href="#">שפה</theory-bar>
                    <theory-bar href="#">הירשם / התחבר</theory-bar>
                </template>

                <template slot="right-bar">
                    <theory-bar href="#">מבחנים</theory-bar>
                    <theory-bar href="#">עמוד הבית</theory-bar>
                </template>
            </theory-nav-bar>

           <router-view></router-view>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
