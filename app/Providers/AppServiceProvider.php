<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
    
    // public function boot()
    // {
    //     Paginator::useBootstrap();
    // }

    public function boot()
    {
        //phan trang bang bootrap
        Paginator::useBootstrap();

        // Chia sẻ biến $nguoidung với tất cả các view
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $nguoidung = Auth::user();
                $view->with('nguoidung', $nguoidung);
            }
        });
    }
}
