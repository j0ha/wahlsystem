<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Form
 *
 * @property int $id
 * @property string $name
 * @property int $election_id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schoolclass[] $schoolclasses
 * @property-read int|null $schoolclasses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Voter[] $voters
 * @property-read int|null $voters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUuid($value)
 * @mixin \Eloquent
 */
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
