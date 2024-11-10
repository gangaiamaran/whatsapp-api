<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

final class SwaggerUiServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('viewSwaggerUI', function ($user = null) {
            return in_array(optional($user)->email, [
                //
            ]);
        });
    }
}