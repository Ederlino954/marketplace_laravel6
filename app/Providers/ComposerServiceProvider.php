<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = \App\Category::all(['name', 'slug']);

        // view()->share('categories', $categories); // padrão de compartilhar com todas as views
        // view()->composer(['welcome', 'single', 'cart'], function($view){

        // view()->composer('*', function($view) use($categories){
        //     $view->with('categories', $categories);
        // });

        view()->composer('*', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
