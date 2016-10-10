<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Quarter;
use App\Models\Subject;
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
        return $view->with('subjects', Auth::user()->subjects()->with('subject','grade','teacher')->get());
      });

      view()->composer('layouts.partials.sidebar', function($view){
        if (Auth::user()->hasRole('class_teacher'))
        {
          $grade = Grade::where('user_id', Auth::user()->id)->first();
          $teachers = Teacher::where('grade_id', $grade->id)->whereIn('subject_id', json_decode($grade->subjects))->with('subject','teacher')->get();
          return $view->with('teachers', $teachers);
        }

      });

      view()->composer('quarters.quarter', function($view){
        return $view->with('quarters', Quarter::with('score.student')->isLive()->latestFirst()->get());
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
