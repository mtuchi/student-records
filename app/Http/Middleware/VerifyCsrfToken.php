<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

use Closure;
use Notify;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
      if($request->input('_token'))
      {
        if ( \Session::getToken() != $request->input('_token'))
        {
          /*
            Checking If Session token matches request token(The token in the input hidden)
            dd(\Session::getToken() == $request->input('_token'));

            Log an error that the session has expired its totally optional
            \Log::error("Expired token found. Redirecting to /");

            flash the error message with redirect response to the login page
            return redirect()->guest('/')
            ->with('global', 'Expired token found. Redirecting to /');

            note: If this if statement is not true , the return value(return parent::handle($request, $next);) will be excuted
            that means if there is the a problem with a token, An ErrorException will be thrown (TokenMismatch exception).

            This may be becaused by forgeting adding the {{ csrf_field() }} in the form
            so the $request->input('_token') can not be found or its empty.

            Notice:
            Am using codecourse/notify (https://github.com/codecourse/notify)
            to flash message thats why i used,

            notify()->flash('Your session has expired. Please try logging in again.', 'warning');
            its totally optional if you want to flash message without the package.
            You can use laravel implimentation. So it will be something like

            return redirect()->guest('/')
            ->with('global', 'Expired token found. Redirecting to /');
          */

          notify()->flash('Your session has expired. Please try logging in again.', 'warning');

          return redirect()->guest('/login');
        }
      }
      return parent::handle($request, $next);
    }
}
