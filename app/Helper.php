<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Helper
 *
 * @property int $id
 * @property string $uuid
 * @property string $token
 * @property int $election_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Helper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Helper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Helper query()
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Helper whereUuid($value)
 * @mixin \Eloquent
 */
class Helper extends Model
{
    protected $casts = [
        'token' => Encrypted::class,
        'email' => Encrypted::class,
    ];
}
