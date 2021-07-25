<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AnswerStoreTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_답변작성_성공()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post("/api/questions/{$question->id}/answers", [
            "content" => "냥냥펀치!!"
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_답변작성_하나의_질문에는_답변이_최대_3개까지_실패()
    {
        $question = Question::factory()->create();
        Answer::factory()
            ->count(3)
            ->create(['question_id' => $question->id]);
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post("/api/questions/{$question->id}/answers", [
            "content" => "냥냥펀치!!"
        ]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_답변작성_멘토만_답변을_작성_가능_실패()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create(['type' => '멘티']);
        $this->actingAs($user);

        $response = $this->post("/api/questions/{$question->id}/answers", [
            "content" => "냥냥펀치!!"
        ]);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_답변작성_존재하지_않는_질문_실패()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post("/api/questions/1/answers", [
            "content" => "냥냥펀치!!"
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
