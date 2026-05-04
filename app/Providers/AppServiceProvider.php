<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Route;
use Dedoc\Scramble\Scramble;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Definisikan Gate
        Gate::define('manage-product', function (User $user) {
            return $user->role === 'admin';
        // gate hanya admin yang bisa manage category
        });
        Gate::define('manage-category', function (User $user) {
            return $user->role === 'admin';
        });

        Scramble::configure()
    ->routes(function (Route $route) {
        return Str::startsWith($route->uri, 'api/');
    });

    Gate::define('viewApiDocs', function () {
    return true;
});
    }
}