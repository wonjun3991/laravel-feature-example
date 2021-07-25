<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AnswerShowTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;


    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_답변상세보기_성공()
    {
        $answer = Answer::factory()->create();

        $response = $this->get("/api/answers/{$answer->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'content',
                'selected',
                'created_at',
                'user' => [
                    'cat_type',
                    'cat_pattern_type',
                    'type'
                ]
            ]
        ]);
    }

    public function test_답변상세보기_존재하지_않는_답변_실패()
    {
        $isNotExistAnswerId = 12314124123;

        $response = $this->get("/api/answers/{$isNotExistAnswerId}");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
