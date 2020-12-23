<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getWithActive($electionId) {
      return DB::select(DB::raw('select DISTINCT forms.* FROM forms, voters WHERE forms.id IN (SELECT voters.form_id FROM voters WHERE voters.voted_via_terminal = 0 AND voters.voted_via_email = 0 AND voters.election_id = :electionId)'), array(
 'electionId' => $electionId,
));
    }
}
