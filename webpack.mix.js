let mix = require('laravel-mix');

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

if (!mix.inProduction()) {
    if (process.env.MIX_BROWSER_SYNC) {
        mix.browserSync(process.env.MIX_BROWSER_SYNC);
    }
}

if (mix.inProduction()) {
    mix.options({
        uglify: {
            uglifyOptions: {
                compress: {
                    drop_console: true
                }
            },
            extractComments: true
        }
    });
}

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/assets/sass')
        }
    }
});

mix.version();

mix.js('resources/assets/js/app.js', 'public/js')
    .extract(['vue']);

mix.sass('resources/assets/sass/App.scss', 'public/css');