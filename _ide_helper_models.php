<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Answer
 *
 * @property int $id
 * @property int $question_id
 * @property int $selected
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
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
 * @method static \Illuminate\Database\Query\Builder|Answer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Answer withoutTrashed()
 * @mixin Builder
 * @property-read \App\Models\Question $question
 */
	class Answer extends \Eloquent {}
}

namespace App\Models{
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
	class CatPatternType extends \Eloquent {}
}

namespace App\Models{
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
	class CatType extends \Eloquent {}
}

namespace App\Models{
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
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
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
	class QuestionType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $email
 * @property int $age
 * @property int $cat_type_id
 * @property int $cat_pattern_type_id
 * @property string $type
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\CatPatternType $catPatternType
 * @property-read \App\Models\CatType $catType
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAge($value)
 * @method static Builder|User whereCatPatternTypeId($value)
 * @method static Builder|User whereCatTypeId($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereType($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Builder
 */
	class User extends \Eloquent {}
}

