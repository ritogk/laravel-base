const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | コンパイル対象ファイル、バンド対象ファイルをここに記述する
 |
 | mix.js('resources/assets/js/app.js', 'public/js'); この記述で以下画実行される
 | ・ES2015記法
 | ・モジュール
 | ・.vueファイルのコンパイル
 | ・開発環境向けに圧縮
 |
 |　生のjsファイルをバンドルする場合は「mix.babel()」を使う。ESS5記法に変換される。
 |  
 |
 |
 |
 */
mix.js('resources/js/admin/admin.js', 'public/js')
    .js("resources/js/admin/router.js", "public/js")
    .js("resources/js/content.js", "public/js")
    .js('resources/js/content/agree.js', 'public/js')
    .js('resources/js/content/confirmation.js', 'public/js')
    .js('resources/js/content/reception.js', 'public/js')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/content.scss', 'public/css')
    .styles(['resources/css/reception.css'], 'public/css/reception.css')
    .version();

mix.webpackConfig({
    resolve: {
        alias: {
            '@admin': path.resolve(__dirname, 'resources/js/admin/')
        }
    }
});

mix.webpackConfig({
    resolve: {
        alias: {
            '@content': path.resolve(__dirname, 'resources/js/content')
        }
    },
    node: {
        fs: 'empty',
    },
});