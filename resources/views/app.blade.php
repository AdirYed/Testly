<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Theory Test</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>

    <header class="min-w-full lg:px-16 px-6 bg-white flex flex-wrap items-center lg:py-0 py-2 fixed top-0 left-0 z-10">
        <div class="flex-1 flex justify-between items-center">
            <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">שפה</a></li>
            </ul>
        </div>

        <label for="menu-toggle" class="pointer-cursor lg:hidden block"><svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg></label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
            <nav>
                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                    <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">התחבר</a></li>
                    <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400 lg:mb-0 mb-2" href="#">הירשם</a></li>
                </ul>
            </nav>
            <a href="#" class="lg:ml-4 flex items-center justify-start lg:mb-0 mb-4 pointer-cursor">
                <img class="rounded-full w-10 h-10 border-2 border-transparent hover:border-indigo-400" src="https://pbs.twimg.com/profile_images/1128143121475342337/e8tkhRaz_normal.jpg" alt="Andy Leverenz">
            </a>

        </div>
    </header>

{{--        <nav id="nav-bar" class="fixed max-w-full min-w-full h-16">--}}
{{--            <section class="flex max-w-6xl">--}}
{{--                <ul class="flex flex-1">--}}
{{--                    <li class="mr-6">--}}
{{--                        <a class="text-blue-500 hover:text-blue-800" href="#">שנה שפה</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}

{{--                <ul class="flex">--}}
{{--                    <li class="mr-6">--}}
{{--                        <a class="text-blue-500 hover:text-blue-800" href="#">התחבר</a>--}}
{{--                    </li>--}}
{{--                    <li class="mr-6">--}}
{{--                        <a class="text-blue-500 hover:text-blue-800" href="#">הירשם</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </section>--}}
{{--        </nav>--}}

        <div id="app" class="container">
            <router-view></router-view>
        </div>

        <div style="margin-bottom: 3000px"></div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
