<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    public function terminals()
    {
      return $this->hasMany('App\Terminal');
    }

    public function voters()
    {
      return $this->hasMany('App\Voter');
    }

    public function candidates()
    {
      return $this->hasMany('App\Candidate');
    }
}
