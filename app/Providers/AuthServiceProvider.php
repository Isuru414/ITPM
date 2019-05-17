<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Courses
        Gate::define('course_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('course_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('course_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('course_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('course_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Lessons
        Gate::define('lesson_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('lesson_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('lesson_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('lesson_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('lesson_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Digital library
        Gate::define('digital_library_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('digital_library_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('digital_library_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('digital_library_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('digital_library_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Wall management
        Gate::define('wall_management_access', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('wall_management_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('wall_management_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('wall_management_view', function ($user) {
            return in_array($user->role_id, [1, 2, 3]);
        });
        Gate::define('wall_management_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
