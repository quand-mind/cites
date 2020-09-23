<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Models\Page;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Slug event
        Page::registerModelEvent('slugging', function ($page) {
            if (strcmp($page->title, 'Bienvenidos') == 0) {
                // the model won't be slugged
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
