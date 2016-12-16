var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) // az összes css, és js fájlt compile-eljük egybe --> kevesebb request -> gyorsabb app
{
    mix.sass('app.scss')

        .styles([ // itt adom melyik mappában keresse melyik css, és js fájlt

            'libs/blog-post.css',
            'libs/bootstrap.css',
            'libs/font-awesome.css',
            'libs/metisMenu.css',
            'libs/sb-admin-2.css',
            'libs/styles.css',
        ],'./public/css/libs.css') // hova akarom lefordítani a fájlokat.. ha nincs ilyen hely, akkor hozza létre !

            .scripts([

                'libs/jquery.js',     // jquery nek kell a bootstrap előtt lenni!! fordítva: inspect console: jquery needed error
                'libs/bootstrap.js',
                'libs/metisMenu.js',
                'libs/sb-admin-2.js',
                'libs/scripts.js',
            ],'./public/js/libs.js')
});
