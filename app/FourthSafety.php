<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\FourthSafety
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $election_uuid
 * @property string $candidate_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety whereCandidateUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety whereElectionUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety whereUpdatedAt($value)
 */
class FourthSafety extends Model
{
    protected $table = 'fourth_safety';

    protected $casts = [
        'candidate_uuid' => Encrypted::class,
    ];
}
