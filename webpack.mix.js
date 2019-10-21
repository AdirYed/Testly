const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.pcss', 'public/css', [
        require('postcss-nested'),
        require('autoprefixer'),
    ])
    .purgeCss()
    .browserSync({
        proxy: 'localhost:8000',
        notify: false,
    })
    .disableNotifications()
    .version();
