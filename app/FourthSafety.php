<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\FourthSafety
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety query()
 * @mixin \Eloquent
 */
class FourthSafety extends Model
{
    protected $connection = 'mysql_backup';
    protected $table = 'fourth_safety';
}
