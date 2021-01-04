<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Candidate
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property mixed|null $image
 * @property int $election_id
 * @property int $votes
 * @property string $uuid
 * @property string $type
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereVotes($value)
 * @mixin \Eloquent
 */
class Candidate extends Model
{

    protected $casts = [
        'name' => Encrypted::class,
        'description' => Encrypted::class,
        'image' => Encrypted::class,
        'type' => Encrypted::class,
    ];

  public static function search($search, $electionId)
    {
        $search2 = hash('sha256', $search);
        return empty($search) ? static::query()->where('election_id', $electionId)
            : static::query()->where('id', 'like', '%'.$search.'%')->where('election_id', $electionId)
                ->orWhere('name_h', 'like', '%'.$search2.'%')->where('election_id', $electionId);
    }
}
