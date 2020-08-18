<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
  public function schoolClass()
  {
    return $this->hasOne('App\Schoolclass');
  }
}
