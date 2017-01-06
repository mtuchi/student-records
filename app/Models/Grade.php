<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id','name','stream','slug'];

    public function user()
    {
      // return $this->belongsTo(User::class,'user_id');
			return $this->morphedByMany(User::class,'gradeable');
    }

		public function teacher()
		{
			// return $this->hasMany(Teacher::class);
			return $this->morphedByMany(Teacher::class,'gradeable');
		}

		public function subject()
		{
			// return $this->belongsToMany(Subject::class);
			return $this->morphedByMany(Subject::class,'gradeable');
		}

		public function student()
		{
			// return $this->belongsToMany(Student::class);
			return $this->morphedByMany(Student::class,'gradeable');
		}

    public function quarter()
    {
      return $this->hasMany(Quarter::class);
    }
}
