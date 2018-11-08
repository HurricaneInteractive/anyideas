let mix = require('laravel-mix');
const Jarvis = require("webpack-jarvis");

if (!mix.inProduction()) {
    if (process.env.MIX_BROWSER_SYNC) {
        mix.browserSync(process.env.MIX_BROWSER_SYNC);
    }
    
    mix.webpackConfig({
        plugins: [
            new Jarvis({
                port: 1337
            })
        ]
    });
}

if (mix.inProduction()) {
    mix.options({
        uglify: {
            uglifyOptions: {
                compress: {
                    drop_console: true,
                    dead_code: true
                },
                ie8: false
            },
            extractComments: true
        }
    });
}

mix.options({
    extractVueStyles: true
});

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/assets/sass')
        }
    }
});

mix.version();
mix.sourceMaps();

mix.js('resources/assets/js/app.js', 'public/js')
    .extract([
        'vue',
        'axios',
        'vuex',
        'lodash',
        'hero-patterns'
    ]);

mix.sass('resources/assets/sass/App.scss', 'public/css');