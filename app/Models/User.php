<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Subject;
use App\Models\Quarter;

class User extends Authenticatable
{
    use Notifiable;
		use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','dob', 'gender','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function grade()
    {
        return $this->belongsToMany(Grade::class);
    }

		public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function joined()
    {
      return $this->created_at->diffForHumans();
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
    * Add roles to user
    */
    public function attachRole($title)
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
           case 'admin':
               $assigned_roles[] = $this->getIdInArray($roles, 'admin');
               break;
           case 'registrar':
               $assigned_roles[] = $this->getIdInArray($roles, 'registrar');
               break;
           default:
               throw new \Exception("The teacher status entered does not exist");
       }

       $this->roles()->attach($assigned_roles);
    }

    public function detachRole($title)
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
           case 'admin':
               $assigned_roles[] = $this->getIdInArray($roles, 'admin');
               break;
           case 'registrar':
               $assigned_roles[] = $this->getIdInArray($roles, 'registrar');
               break;
           default:
               throw new \Exception("The teacher status entered does not exist");
       }

       $this->roles()->detach($assigned_roles);
    }

    public function avatar($options = [])
    {
      $size = isset($options['size']) ? $options['size']:45;
      $image = isset($options['image']) ? $options['image']:'identicon';

      return 'http://www.gravatar.com/avatar/' .md5($this->email). '?s=' . $size . '&d='. $image;
    }

}
