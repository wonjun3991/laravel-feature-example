<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CatType
 *
 * @property int $id
 * @property string $type
 * @method static Builder|CatType newModelQuery()
 * @method static Builder|CatType newQuery()
 * @method static Builder|CatType query()
 * @method static Builder|CatType whereId($value)
 * @method static Builder|CatType whereType($value)
 * @mixin Builder
 */
class CatType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public $timestamps = false;
}
