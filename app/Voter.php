<?php

namespace App;

use App\Casts\Encrypted;
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
 * @property int $activated
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereActivated($value)
 */
class Voter extends Model
{

  public $fillable = ['surname', 'name', 'birth_year', 'email', 'election_id', 'schoolclass_id', 'form_id'];

    protected $casts = [
        'name' => Encrypted::class,
        'surname' => Encrypted::class,
        'email' => Encrypted::class,
        'birth_year' => Encrypted::class,
    ];

  public static function search($search, $electionId)
    {
        $search2 = hash('sha256', $search);
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name_h', 'like', '%'.$search2.'%')->where('election_id', $electionId)
                ->orWhere('surname_h', 'like', '%'.$search2.'%')->where('election_id', $electionId);
    }

    public function schoolclass() {
      return $this->belongsTo('App\Schoolclass');
    }
}
