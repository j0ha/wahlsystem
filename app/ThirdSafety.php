<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ThirdSafety
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $election_uuid
 * @property string $candidate_uuid
 * @property int $candidate_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety whereCandidateUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety whereCandidateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety whereElectionUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety whereUpdatedAt($value)
 */
class ThirdSafety extends Model
{
    protected $table = 'third_safety';

    protected $casts = [
        'election_uuid' => Encrypted::class,
        'candidate_uuid' => Encrypted::class,
    ];
}
