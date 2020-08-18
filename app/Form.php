<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
  public function Schoolclasses()
  {
    return $this->hasMany('App\Schoolclass');
  }
}
