<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;
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

        Passport::routes();
        
        Passport::tokensCan([
            'read' => 'Index, Show',
            'create' => 'Store, Create',
            'update' => 'Edit', 'Update',
            'delete' => 'Delete',
            'user-read' => 'User read - index, show',
            'user-create' => 'User create - create, save',
            'module-read' => 'Module read -index, show',
            'lesson-show' => 'Lesson show - show',
            'session-view-edit' => 'Session view - view, update'
          ]);

//        Passport::tokensExpireIn(Carbon::now()->addDays(1));
//
//        Passport::refreshTokensExpireIn(Carbon::now()->addDays(2));
    }
}
