<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Events\UserRegistered;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
			User::created(function($user){

        //  generating random token
				$token = $user->activationToken()->updateOrCreate([
					'token' => str_random(128),
				]);

				// Assign admin role
				$user->giveRole('admin');

       //  Sending an email
       event(new UserRegistered($user));
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
			if($this->app->environment() == 'local')
			{
				$this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
			}
    }
}
