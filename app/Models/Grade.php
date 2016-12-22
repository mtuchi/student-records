<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['user_id','name','slug','subjects','students'];

    public function subject()
    {
      return $this->hasMany(Subject::class);
    }

    public function students()
    {
      return $this->hasMany(Student::class);
    }

    public function user()
    {
      return $this->hasOne(User::class);
    }

    public function quarter()
    {
      return $this->hasMany(Quarter::class);
    }
}
