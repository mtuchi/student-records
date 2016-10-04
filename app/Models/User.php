<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Subject;
use App\Models\Quarter;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
    * Find out if User is a teacher, based on if has any roles     *
      * @return boolean
    */
    public function isTeacher()
    {
         $roles = $this->roles->toArray();
         return !empty($roles);
    }

    /**
    * Find out if user has a specific role
    *
    * $return boolean
    */
    public function hasRole($role)
    {
        $roles = collect($this->roles->pluck('name')->toArray());
        return $roles->contains($role);
    }

    /**
    * Get key in array with corresponding value
    *
    * @return int
    */
    private function getIdInArray($array, $term)
    {
       foreach ($array as $key => $value) {
           if ($value['name'] == $term) {
               return $key;
           }
       }

       throw new UnexpectedValueException;
    }

    /**
    * Add roles to user to make them a teacher
    */
    public function makeTeacher($title)
    {
        $assigned_roles = [];
        $roles = Role::all()->keyBy('id')->toArray();

       switch ($title)
       {
           case 'class_teacher':
               $assigned_roles[] = $this->getIdInArray($roles, 'class_teacher');
               break;

           case 'teacher':
               $assigned_roles[] = $this->getIdInArray($roles, 'teacher');
               break;
           default:
               throw new \Exception("The teacher status entered does not exist");
       }

       $this->roles()->attach($assigned_roles);
    }

}
