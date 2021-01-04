<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Election
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int|null $abstention
 * @property string $status
 * @property string $uuid
 * @property string $type
 * @property int|null $permission_id
 * @property string|null $activeby
 * @property string|null $activeto
 * @property mixed|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Candidate[] $candidates
 * @property-read int|null $candidates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Terminal[] $terminals
 * @property-read int|null $terminals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Voter[] $voters
 * @property-read int|null $voters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Election newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Election newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Election query()
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereAbstention($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereActiveby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereActiveto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereUuid($value)
 * @mixin \Eloquent
 * @property int $statistics
 * @property string|null $realstart
 * @property string|null $realend
 * @property int $manual_voter_activation
 * @property string|null $email_sendtime
 * @property string|null $email_terminal
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereEmailSendtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereEmailTerminal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereManualVoterActivation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereRealend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereRealstart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereStatistics($value)
 */
class Election extends Model
{
    protected $casts = [
        'name' => Encrypted::class,
        'description' => Encrypted::class,
        'type' => Encrypted::class,
        'activeby' => Encrypted::class,
        'activeto' => Encrypted::class,
        'realstart' => Encrypted::class,
        'realend' => Encrypted::class,
        'logo' => Encrypted::class,
        'email_sendtime' => Encrypted::class,
        'email_terminal' => Encrypted::class,
    ];

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

    public function schoolclasses() {
      return $this->hasMany(App\Schoolclass);
    }

    public function forms() {
      return $this->hasMany(App\Form);
    }
}
