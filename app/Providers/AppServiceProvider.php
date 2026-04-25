<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
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
    }
}