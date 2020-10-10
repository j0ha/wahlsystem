<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emailelection extends Model
{
    public function emailvoters(){

    return $this->hasMany('App\Emailvoter');

    }
}
