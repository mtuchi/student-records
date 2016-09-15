<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Quarter;

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

      view()->composer('quarters.quarter', function($view){
        return $view->with('quarters', Quarter::isLive()->get());
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
