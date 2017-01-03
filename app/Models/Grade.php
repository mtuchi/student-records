<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id','name','slug'];

    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }

		public function teacher()
		{
			return $this->hasMany(Teacher::class);
		}

		public function subject()
		{
			return $this->belongsToMany(Subject::class);
		}

		public function student()
		{
			return $this->belongsToMany(Student::class);
		}

    public function quarter()
    {
      return $this->hasMany(Quarter::class);
    }
}
