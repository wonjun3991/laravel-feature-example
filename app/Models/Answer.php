<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Answer
 *
 * @property int $id
 * @property int $question_id
 * @property int $user_id
 * @property int $selected
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Question $question
 * @property-read \App\Models\User $user
 * @method static Builder|Answer newModelQuery()
 * @method static Builder|Answer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Answer onlyTrashed()
 * @method static Builder|Answer query()
 * @method static Builder|Answer whereContent($value)
 * @method static Builder|Answer whereCreatedAt($value)
 * @method static Builder|Answer whereDeletedAt($value)
 * @method static Builder|Answer whereId($value)
 * @method static Builder|Answer whereQuestionId($value)
 * @method static Builder|Answer whereSelected($value)
 * @method static Builder|Answer whereUpdatedAt($value)
 * @method static Builder|Answer whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Answer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Answer withoutTrashed()
 * @mixin Builder
 */
class Answer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question_id',
        'selected',
        'content',
        'created_at'
    ];

    protected $casts = [
        'selected' => 'boolean'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    public function isSelected(): bool
    {
        return $this->selected === true;
    }
}
