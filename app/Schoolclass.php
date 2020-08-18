<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    protected $table = 'classes';

    public function voters() {
      return $this->hasMany('App\Voters');
    }
}
