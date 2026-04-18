<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
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
        
        // Use protocol https if i am not using local
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        Gate::define('update_user', function(User $authUser, User $targetUser) : bool|Response
        {
            return $authUser->id ===  $targetUser->id
                    ? Response::allow()
                    : Response::denyAsNotFound();
        });
    }
}
