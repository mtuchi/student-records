<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quarter;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuarterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the quarter.
     *
     * @param  App\User  $user
     * @param  App\Quarter  $quarter
     * @return mixed
     */
    public function view(User $user, Quarter $quarter)
    {
        dd($user->subjects);
        return $user->subjects[0]->subject_id === $quarter->score->subject_id;
    }

    /**
     * Determine whether the user can create quarters.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the quarter.
     *
     * @param  App\User  $user
     * @param  App\Quarter  $quarter
     * @return mixed
     */
    public function update(User $user, Quarter $quarter)
    {
        //
    }

    /**
     * Determine whether the user can delete the quarter.
     *
     * @param  App\User  $user
     * @param  App\Quarter  $quarter
     * @return mixed
     */
    public function delete(User $user, Quarter $quarter)
    {
        //
    }
}
