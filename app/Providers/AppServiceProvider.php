<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Wishlists;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view){
            $cartCount = auth()->check() ? Cart::where('user_id', auth()->id())->sum('quantity') : 0;
            $view->with('cartCount', $cartCount);



        });
        View::composer('*', function($view){
            $wishlistCount = auth()->check() ? Wishlists::where('user_id', auth()->id())->count() : 0;
            $view->with('wishlistCount', $wishlistCount);
        });
    }
}
