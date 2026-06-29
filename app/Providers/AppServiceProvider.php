<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Post;
//use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Events\Registered;


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

        Paginator::useBootstrap();

        RateLimiter::for('api', function (Request $request) {
        return Limit::perMinute(60)->by(
            $request->user()?->id ?: $request->ip()
        );
    });


        Gate::define('create-post',[PostPolicy::class,'store']);
        Gate::define('update-post',[PostPolicy::class,'update']);
        Gate::define('delete-post',[PostPolicy::class,'destroy']);

        Gate::define('create-user',[UserPolicy::class,'store']);
        Gate::define('update-user',[UserPolicy::class,'update']);
        Gate::define('delete-user',[UserPolicy::class,'delete']);



    }
}
