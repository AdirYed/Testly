const mix = require("laravel-mix");
require("laravel-mix-purgecss");

mix
  .js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.pcss", "public/css", [
    require("tailwindcss"),
    require("postcss-nested"),
    require("autoprefixer"),
  ])
  .browserSync({
    proxy: "localhost:8000",
    notify: false,
  })
  .disableNotifications();

if (mix.inProduction()) {
  mix.version().purgeCss();
}
