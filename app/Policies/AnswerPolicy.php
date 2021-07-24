<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isMentor();
    }

    public function update(User $user, Answer $question)
    {
        return $user->id === $question->user_id;
    }

    public function delete(User $user, Answer $question)
    {
        return $user->id === $question->user_id;
    }
}
