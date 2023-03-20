<?php

namespace App\Providers;

use App\Models\User;
use App\View\Components\ModalForm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        view()->share('theme', 'lte');
        Paginator::useBootstrap();

        Gate::define('esAdmin', function (User $user) {
            return $user->tipoUsuario === 1                
            ? Response::allow()
            : Response::deny('Debes ser administrador.');
        });
    }
}
