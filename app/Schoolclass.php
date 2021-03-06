<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Schoolclass
 *
 * @property int $id
 * @property string $name
 * @property int $election_id
 * @property int $form_id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereUuid($value)
 * @mixin \Eloquent
 */
class Schoolclass extends Model
{
    protected $table = 'classes';

    public function voters() {
      return $this->hasMany('App\Voters');
    }

    public static function search($search, $electionId)
      {
          $search2 = hash('sha256', $search);
          return empty($search) ? static::query()->where('election_id', $electionId)
              : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                  ->orWhere('name_h', 'like', '%'.$search2.'%')->where('election_id', $electionId);
      }

      public static function getWithActive($formId) {
        return DB::select(DB::raw('select DISTINCT classes.* FROM classes, voters WHERE classes.id IN (SELECT voters.schoolclass_id FROM voters WHERE voters.voted_via_terminal = 0 AND voters.voted_via_email = 0 AND voters.form_id = :formId)'), array(
   'formId' => $formId,
 ));
      }

    public static function getWithActiveActivation($formId) {
        return DB::select(DB::raw('select DISTINCT classes.* FROM classes, voters WHERE classes.id IN (SELECT voters.schoolclass_id FROM voters WHERE voters.voted_via_terminal = 0 AND voters.voted_via_email = 0 AND voters.activated = 1 AND voters.form_id = :formId)'), array(
            'formId' => $formId,
        ));
    }
}
