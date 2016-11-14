<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quarter;

class Month extends Model
{
    protected $fillables = ['name'];

    public function quarter()
    {
      return $this->belongsTo(Quarter::class);
    }

    public function score()
    {
      return $this->hasMany(Score::class);
    }
}
