<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['name','subjects','students'];

    public function subjects()
    {
      return $this->hasMany(Subject::class);
    }

    public function user()
    {
      return $this->hasOne(User::class);
    }
}
