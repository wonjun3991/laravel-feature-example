<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property int $question_type_id
 * @property int $user_id
 * @property string $title
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static Builder|Question newModelQuery()
 * @method static Builder|Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|Question onlyTrashed()
 * @method static Builder|Question query()
 * @method static Builder|Question whereContent($value)
 * @method static Builder|Question whereCreatedAt($value)
 * @method static Builder|Question whereDeletedAt($value)
 * @method static Builder|Question whereId($value)
 * @method static Builder|Question whereQuestionTypeId($value)
 * @method static Builder|Question whereTitle($value)
 * @method static Builder|Question whereUpdatedAt($value)
 * @method static Builder|Question whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Question withoutTrashed()
 * @mixin Builder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Answer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\QuestionType $questionType
 * @property-read \App\Models\User $user
 */
class Question extends Model
{
    use SoftDeletes;

    public const MAX_ANSWERS_LIMIT = 3;

    protected $fillable = [
        'title',
        'content',
        'created_at',
    ];

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function questionType()
    {
        return $this->belongsTo('App\Models\QuestionType');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function hasAnswer()
    {
        return $this->answers()->exists();
    }

    public function hasSelectedAnswer()
    {
        return $this->answers()->whereSelected('true')->exists();
    }

    public function hasAnswerMoreThanLimit()
    {
        return $this->answers()->count() > self::MAX_ANSWERS_LIMIT;
    }
}
