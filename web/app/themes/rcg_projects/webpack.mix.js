const mix = require("laravel-mix");
//require("@tinypixelco/laravel-mix-wp-blocks");
require("laravel-mix-copy-watched");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath("./dist");

mix
  .sass("resources/assets/styles/app.scss", "styles")
  .sass("resources/assets/styles/editor.scss", "styles");

mix
  .js("resources/assets/scripts/app.js", "scripts")
  .js("resources/assets/scripts/customizer.js", "scripts")
  .extract(["lazysizes", "gsap", "swiper", "locomotive-scroll"]);

mix
  .copyWatched("resources/assets/images/**", "dist/images")
  .copyWatched("resources/assets/fonts/**", "dist/fonts")
  .copyWatched("resources/assets/svg/**", "dist/svg");

mix.autoload({
  jquery: ["$", "window.jQuery"],
});

mix.options({
  processCssUrls: false,
});

