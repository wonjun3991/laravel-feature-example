<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CatPatternType
 *
 * @property int $id
 * @property string $type
 * @method static Builder|CatPatternType newModelQuery()
 * @method static Builder|CatPatternType newQuery()
 * @method static Builder|CatPatternType query()
 * @method static Builder|CatPatternType whereId($value)
 * @method static Builder|CatPatternType whereType($value)
 * @mixin Builder
 */
class CatPatternType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public $timestamps = false;
}
