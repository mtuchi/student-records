<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Quarter;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Score;
use App\Models\Grade;
use App\Models\Teacher;

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
        if (Auth::user()->hasRole('teacher'))
        {
					// dd(Auth::user()->teacher()->with('grade')->get());
          return $view->with('teachers', Auth::user()->grade()->get());
        }
      });

      view()->composer('layouts.partials.sidebar', function($view){
        if (Auth::user()->hasRole('class_teacher'))
        {
          $grade = Grade::where('user_id', Auth::user()->id)->with('teacher.user')->first();
          return $view->with('grade', $grade);
        }
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
