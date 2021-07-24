<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuestionType
 *
 * @property int $id
 * @property string $type
 * @method static Builder|QuestionType newModelQuery()
 * @method static Builder|QuestionType newQuery()
 * @method static Builder|QuestionType query()
 * @method static Builder|QuestionType whereId($value)
 * @method static Builder|QuestionType whereType($value)
 * @mixin Builder
 */
class QuestionType extends Model
{
    protected $fillable = [
        'type'
    ];

    public $timestamps = false;
}
