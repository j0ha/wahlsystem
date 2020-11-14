<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
  public function voters() {
    return $this->hasMany('App\Voter');
  }

  public function schoolclasses() {
    return $this->hasMany('App\Schoolclass');
  }

  public static function search($search, $electionId)
    {
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name', 'like', '%'.$search.'%')->where('election_id', $electionId);
    }
}
