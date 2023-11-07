<?php

namespace App\Providers;

use App\Contracts\BreadcrumbsServiceInterface;
use App\Contracts\ClusterServiceInterface;
use App\Services\BreadcrumbsService;
use App\Services\ClusterService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        BreadcrumbsServiceInterface::class => BreadcrumbsService::class,
        ClusterServiceInterface::class => ClusterService::class,
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
