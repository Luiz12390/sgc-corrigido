<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Rotas de API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rotas Web Principais
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Carregando cada arquivo de rota adicional explicitamente
            // A ordem aqui não importa.
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            Route::middleware('web')
                ->group(base_path('routes/users.php'));

            Route::middleware('web')
                ->group(base_path('routes/organizations.php'));

            Route::middleware('web')
                ->group(base_path('routes/projects.php'));

            Route::middleware('web')
                ->group(base_path('routes/challenges.php'));

            Route::middleware('web')
                ->group(base_path('routes/communities.php'));

            Route::middleware('web')
                ->group(base_path('routes/resources.php'));
        });
    }
}
