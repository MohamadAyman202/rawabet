<?php

namespace App\Providers;

use App\View\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $routes_paths = [
            'frontend.home', 'frontend.pages.product.details',
            'frontend.pages.product.index', 'frontend.include.header',
            'frontend.pages.profile.index', 'frontend.pages.product.all_products',
            'frontend.pages.setting.index', 'frontend.pages.payment.checkout',
        ];
        View::composer($routes_paths, UserComposer::class);
    }
}
