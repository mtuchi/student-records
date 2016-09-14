<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Quater;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('layouts.partials.sidebar', function($view){
        return $view->with('subjects', Auth::user()->subjects()->get());
      });

      view()->composer('quaters.quater', function($view){
        return $view->with('quaters', Quater::isLive()->get());
      });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
