<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivationToken;
use App\Events\ResendActivation;

class ActivationController extends Controller
{
    public function activate(ActivationToken $token)
		{
			$token->user()->update([
				'active' => true
			]);

			$token->delete();

			Auth::login($token->user);

			return redirect('/home')->with('success','Welcome, your account activation was successfull.');
		}

		public function resend(Request $request)
		{
			$user = User::byEmail($request->email)->firstOrFail();
      if ($user->active) {
        # user already activated
				return redirect('/login')->with('info',''. $user->name .' already activated');
      }

      event(new ResendActivation($user));

			return redirect('/login')->with('info',''. $user->name .' activation email was resend');
		}
}
