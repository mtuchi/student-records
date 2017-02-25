<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Repositories\HasPermissionTrait;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasPermissionTrait;

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
        'name', 'email', 'password','username','dob', 'gender','phone','active'
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
        return $this->morphToMany(Grade::class,'gradeable');
    }

		public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }

    public function joined()
    {
      return $this->created_at->diffForHumans();
    }

    public function avatar($options = [])
    {
      $size = isset($options['size']) ? $options['size']:45;
      $image = isset($options['image']) ? $options['image']:'identicon';

      return 'http://www.gravatar.com/avatar/' .md5($this->email). '?s=' . $size . '&d='. $image;
    }

    public function activationToken()
    {
      return $this->hasOne(ActivationToken::class);
    }

    public static function byEmail($email)
    {
      return static::where('email',$email);
    }

		public function invitationToken()
		{
			return $this->hasMany(Invitation::class);
		}

}
