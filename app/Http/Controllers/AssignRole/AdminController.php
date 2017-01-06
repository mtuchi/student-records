<?php

namespace App\Http\Controllers\AssignRole;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

use Auth;
class AdminController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			$user = User::find($id);
			# check if the user is arleady an admin
			if ($user->hasRole('admin')) {
				# already assigned an administrator role
				notify()->flash($user->name." is already assigned an administrator role, choose another user", 'danger');

				return redirect($id.'/edit')
							 ->withInput();
			}else {
				$user->attachRole('admin');

				activity('attach-admin')
				->causedBy(Auth::user())
				->performedOn($user)
				->log($user->name." Is assigned administrator role by ". Auth::user()->name);

				notify()->flash($user->name." Is assigned administrator role by ". Auth::user()->name, 'success');

				return redirect('teachers');
			}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$user = User::find($id);
			$user->detachRole('admin');

			activity('detach-admin-role')
			->causedBy(Auth::user())
			->performedOn($user)
			->log($user->name." Records has been detached successful by ". Auth::user()->name);

			notify()->flash($user->name. "Administrator record detached", 'success');

			return redirect('teachers');
    }
}
