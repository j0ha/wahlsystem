<?php

namespace App;

use App\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Securityreport
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $description
 * @property string|null $error
 * @property string|null $file
 * @property string $importance
 * @property string|null $election_uuid
 * @property string|null $additional_info
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport query()
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereAdditionalInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereElectionUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereImportance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Securityreport whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Securityreport extends Model
{

    protected $casts = [
        'description' => Encrypted::class,
        'error' => Encrypted::class,
        'file' => Encrypted::class,
        'election_uuid' => Encrypted::class,
        'importance' => Encrypted::class,
        'additional_info' => Encrypted::class,
    ];

    public static function search($search)
    {
        $search2 = hash('sha256', $search);
        return empty($search) ? static::query()->where('id', '>=', 1)
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('description_h', 'like', '%'.$search2.'%');
    }
}
