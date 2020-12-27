<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Voter
 *
 * @property int $id
 * @property string|null $surname
 * @property string|null $name
 * @property string|null $birth_year
 * @property int $voted_via_email
 * @property int $voted_via_terminal
 * @property int $got_email
 * @property string $uuid
 * @property string $direct_uuid
 * @property string|null $direct_token
 * @property string|null $email
 * @property int $election_id
 * @property int|null $schoolclass_id
 * @property int|null $form_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Schoolclass|null $schoolclass
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereDirectToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereDirectUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereGotEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereSchoolclassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereVotedViaEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereVotedViaTerminal($value)
 * @mixin \Eloquent
 */
class Voter extends Model
{
  public $fillable = ['surname', 'name', 'birth_year', 'email', 'election_id', 'schoolclass_id', 'schoolclass_id'];

  public static function search($search, $electionId)
    {
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('surname', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('email', 'like', '%'.$search.'%')->where('election_id', $electionId);
    }

    public function schoolclass() {
      return $this->belongsTo('App\Schoolclass');
    }
}
