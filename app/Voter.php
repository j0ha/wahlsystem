<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
  public static function search($search, $electionId)
    {
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('surname', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('email', 'like', '%'.$search.'%')->where('election_id', $electionId);
    }
}
