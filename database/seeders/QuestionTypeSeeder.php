<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    private const QUESTION_TYPE_ARRAY = [
        '사료',
        '그루밍',
        '집사 후기'
    ];

    public function run()
    {
        foreach(self::QUESTION_TYPE_ARRAY as $questionType){
            $qt = new QuestionType();
            $qt->type = $questionType;
            $qt->save();
        }
    }
}
