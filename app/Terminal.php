<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Terminal
 *
 * @property int $id
 * @property string $name
 * @property string $kind
 * @property string $description
 * @property string $position
 * @property string $status
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $ip_restriction
 * @property string $uuid
 * @property int $election_id
 * @property int|null $hits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereIpRestriction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereUuid($value)
 * @mixin \Eloquent
 */
class Terminal extends Model
{
    protected $casts = [
        'name' => Encrypted::class,
        'decription' => Encrypted::class,
        'position' => Encrypted::class,
        'status' => Encrypted::class,
        'start_time' => Encrypted::class,
        'end_time' => Encrypted::class,
        'ip_restriction' => Encrypted::class,
    ];

  public static function search($search, $electionId)
    {
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('position', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('kind', 'like', '%'.$search.'%')->where('election_id', $electionId);
    }
}
