<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
		public $fillable = ['email', 'token'];

		public function getRouteKeyName()
		{
			return 'token';
		}
    public function user()
		{
			return $this->belongsToMany(User::class);
		}
}
