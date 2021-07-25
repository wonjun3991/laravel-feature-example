<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AnswerIndexTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_답변보기_성공()
    {
        $answer = Answer::factory()->create();
        $question = $answer->question;
        $response = $this->get("/api/questions/{$question->id}/answers");
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_답변보기_존재하지_않는_질문_실패()
    {
        $isNotExistQuestionId = 312312321;

        Answer::factory()->create();
        $response = $this->get("/api/questions/{$isNotExistQuestionId}/answers");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
