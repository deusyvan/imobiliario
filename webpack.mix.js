const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
   .sass('resources/views/admin/assets/scss/reset.scss', 'public/backend/assets/css/reset.css')
   .sass('resources/views/admin/assets/scss/boot.scss', 'public/backend/assets/css/boot.css')
   .sass('resources/views/admin/assets/scss/login.scss', 'public/backend/assets/css/login.css')

   .copyDirectory('resources/views/admin/assets/css/fonts','public/backend/assets/css/fonts')

   .copyDirectory('resources/views/admin/assets/images','public/backend/assets/images')

   .options({
      processCssUrls: false
   })

   .version()
;
