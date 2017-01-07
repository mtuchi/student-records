<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id','name','stream','slug'];

    public function user()
    {
			return $this->morphedByMany(User::class,'gradeable');
    }

		public function teacher()
		{
			return $this->morphedByMany(Teacher::class,'gradeable');
		}

		public function subject()
		{
			return $this->morphedByMany(Subject::class,'gradeable');
		}

		public function student()
		{
			return $this->morphedByMany(Student::class,'gradeable');
		}

    public function quarter()
    {
      return $this->hasMany(Quarter::class);
    }
}
