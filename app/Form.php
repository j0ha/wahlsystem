<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
  public function voters() {
    return $this->hasMany('App\Voter');
  }
}
