<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quater extends Model
{
  protected $fillable = ['name','live'];
  
  public function scopeIsLive($query)
  {
    return $query->where('live', true);
  }
}
