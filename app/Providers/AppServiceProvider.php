<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Http\Middleware\RoleMiddleware;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Custom route middleware ro‘yxatdan o‘tkazish
        Route::middleware('role', RoleMiddleware::class);

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

//            Route::middleware('api')
//                ->prefix('api')
//                ->group(base_path('routes/api.php'));
        });
    }
}
