<?php

namespace App\Providers;

use View;
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
        View::composer([
            'auth/passwords/email',
            'auth/login',
            'auth/register',
            'auth/verify',
            'cart',
            'category_rooms',
            'detail_room',
            'index',
            'info_user',
            'list_room',
            'oder_room',
            'home',
            'socket',
            'order_room'
        ], 'App\Http\ViewComposers\HeaderComposer');
    }
}
