<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
  public static function search($search, $electionId)
    {
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('position', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('kind', 'like', '%'.$search.'%')->where('election_id', $electionId);
    }
}
