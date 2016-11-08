<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the teacher.
     *
     * @param  App\User  $user
     * @param  App\Teacher  $teacher
     * @return mixed
     */
    public function view(User $user, Teacher $teacher)
    {
        dd($teacher->user_id);
        return $user->id === $teacher->user_id;
    }

    /**
     * Determine whether the user can create teachers.
     *
     * @param  App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the teacher.
     *
     * @param  App\User  $user
     * @param  App\Teacher  $teacher
     * @return mixed
     */
    public function update(User $user, Teacher $teacher)
    {
      return $user->id === $teacher->user_id;
    }

    /**
     * Determine whether the user can delete the teacher.
     *
     * @param  App\User  $user
     * @param  App\Teacher  $teacher
     * @return mixed
     */
    public function delete(User $user, Teacher $teacher)
    {
      return $user->id === $teacher->user_id;
    }
}
