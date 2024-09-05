<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Post::class => PostPermissions:class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate => Permission | simple Role

        // Role
        Gate::define('admin', function (User $user): bool {
            return $user->is_admin;
        });

        // Permission
        // Gate::define('post.edit', function (User $user, Post $post): bool {
        //     return ($user->is_admin || $user->id == $post->user_id);
        // });

        // Gate::define('post.delete', function (User $user, Post $post): bool {
        //     return ($user->is_admin || $user->id == $post->user_id);
        // });
    }
}
