<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuestionShowTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);

    }

    public function test_질문상세보기_성공()
    {
        $answer = Answer::factory()->create();
        $question = $answer->question;

        $response = $this->get("/api/questions/{$question->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data'=>[
                'id',
                'title',
                'content',
                'created_at',
                'question_type',
                'answers'=>[
                    '*'=>[
                        'content',
                        'selected',
                        'created_at',
                        'user'=>[
                            'cat_type',
                            'cat_pattern_type',
                            'type'
                        ]
                    ]
                ],
                'user'=>[
                    'cat_type',
                    'cat_pattern_type',
                    'type'
                ],
            ]
        ]);
    }

    public function test_질문상세보기_존재하지않는질문_실패()
    {
        $isNotExistQuestionId = 12314124123;

        $response = $this->get("/api/questions/{$isNotExistQuestionId}");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
