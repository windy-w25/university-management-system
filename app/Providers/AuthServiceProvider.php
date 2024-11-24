<?php

// app/Providers/AuthServiceProvider.php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerPolicies();

        // Define role-based gates
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'Admin';
        });

        Gate::define('isAcademicHead', function ($user) {
            return $user->role === 'AcademicHead';
        });

        Gate::define('isTeacher', function ($user) {
            return $user->role === 'Teacher';
        });

        Gate::define('isStudent', function ($user) {
            return $user->role === 'Student';
        });

        Gate::define('isAdminOrAcademicHead', function ($user) {
            return $user->role === 'Admin' || $user->role === 'AcademicHead';
        });

        Gate::define('isAdminOrTeacher', function ($user) {
            return $user->role === 'Admin' || $user->role === 'Teacher';
        });

        Gate::define('isAdminOrStudent', function ($user) {
            return $user->role === 'Admin' || $user->role === 'Student';
        });
    }
}



// namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// class AuthServiceProvider extends ServiceProvider
// {
//     /**
//      * The policy mappings for the application.
//      *
//      * @var array
//      */
//     protected $policies = [
//         // 'App\Model' => 'App\Policies\ModelPolicy',
//     ];

//     /**
//      * Register any authentication / authorization services.
//      *
//      * @return void
//      */
//     public function boot()
//     {
//         $this->registerPolicies();

//         //
//     }
// }
