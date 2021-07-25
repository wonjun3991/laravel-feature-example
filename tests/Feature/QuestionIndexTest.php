<?php

namespace Tests\Feature;

use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuestionIndexTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_질문목록_페이지당_개수가_9인지()
    {
        Question::factory()->create();

        $response = $this->get('/api/questions');
        $response->assertJson(['meta' => ['per_page' => 9]]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_질문목록_성공()
    {
        Question::factory()->create();

        $response = $this->get('/api/questions');
        $response->assertStatus(Response::HTTP_OK);
    }
}
