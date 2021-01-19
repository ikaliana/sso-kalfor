<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Models\Passport\Client;
use Illuminate\Support\Facades\Route;
// use Laravel\Passport\Http\Controllers\AccessTokenController;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
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
        Passport::useClientModel(Client::class);

        Route::post('/oauth/token', [
            'uses' => 'App\Http\Controllers\AccessTokenController@issueToken',
            'as' => 'passport.token',
            'middleware' => ['throttle'],
        ]);

    }
}
