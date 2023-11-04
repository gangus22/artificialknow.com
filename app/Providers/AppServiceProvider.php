<?php

namespace App\Providers;

use App\Contracts\BreadcrumbsServiceInterface;
use App\Services\BreadcrumbsService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        BreadcrumbsServiceInterface::class => BreadcrumbsService::class,
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
