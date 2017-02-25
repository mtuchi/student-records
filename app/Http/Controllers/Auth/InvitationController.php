<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invitation;

class InvitationController extends Controller
{
		public function register(Request $request)
		{

		}

    public function invite(Invitation $invitation)
		{
			dd($invitation);
		}

		public function resend(Request $request)
		{

		}
}
