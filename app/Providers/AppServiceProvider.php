<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Member;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('view', function (User $user) {
            if ($user->status === "pending") {
                return false;
            }
            return $user->role === "admin"; // Allow access for admin role
        });
        
        Gate::define('user', function (User $user) {
            $member = Member::where('user_id', $user->id)->first();
            if ($user->status === "pending") {
                return false;
            }
            return $user->role === "user" && $member->status !== "blocked" && $member->status !== "inactive";
        });

        Gate::define('out_of_date', function (User $user) {
            $member = Member::where('user_id', $user->id)->first();
            if ($user->status === "pending") {
                return false;
            }
            return $user->role === "user" && $member->status === "inactive";
        });

        Gate::define('blocked', function (User $user) {
            $member = Member::where('user_id', $user->id)->first();
           if ($user->status === "pending") {
                return false;
            }
            return $user->role === "user" && $member->status === "blocked";
        });

         Paginator::useBootstrap();
     
    }
}