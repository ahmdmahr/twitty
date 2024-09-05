<?php

// this file is excuted before running the app

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

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


        Paginator::useBootstrapFive();

        // [$topUsers = Cache::remember('topUsers', 60*3 , function ())] => seconds


        // $topUsers = Cache::rememberForever('key', function () {
            
        // });

        $topUsers = Cache::remember('topUsers', now()->addDays(5) , function () {
            return User::withCount('posts')
            ->orderby('posts_count','DESC')
            ->limit(5)->get();
        });

        // Cache::flush();  => clear all caches

        // Cache::forget('key'); => remove specific caches keys


        View::share(
            'topUsers',
            $topUsers
        );
        //  App::setLocale('ar');
        // app()->setLocale('ar');
    }
}
