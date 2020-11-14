<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    protected $table = 'classes';

    public function voters() {
      return $this->hasMany('App\Voters');
    }

    public static function search($search, $electionId)
      {
          return empty($search) ? static::query()->where('election_id', $electionId)
              : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                  ->orWhere('name', 'like', '%'.$search.'%')->where('election_id', $electionId);
      }
}
