<?php

namespace App\Providers;

use App\Contracts\BreadcrumbsServiceInterface;
use App\Contracts\RedirectServiceInterface;
use App\Services\BreadcrumbsService;
use App\Services\RedirectService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        BreadcrumbsServiceInterface::class => BreadcrumbsService::class,
        RedirectServiceInterface::class => RedirectService::class,
    ];

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
        Model::unguard();
    }
}
