<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

		/**
		 * The user has been authenticated.
		 * @param  Illuminate\Http\Request $request
		 * @param  mixed  $user
		 * @return mixed
		 */
		protected function authenticated(Request $request, $user)
		{
			if (!$user->active) {
					Auth::logout();
					return redirect('/login')->with('error','Please activate your account
					<a href="'.route('auth.activate.resend'). '?email='. $user->email .'">Resend Activation Email</a>');
			}
		}
}
