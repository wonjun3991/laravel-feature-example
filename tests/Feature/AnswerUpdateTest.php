<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AnswerUpdateTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_답변수정_채택_성공()
    {
        $answer = Answer::factory()->create();
        $user = $answer->question->user;
        $this->actingAs($user);

        $response = $this->patch("/api/answers/{$answer->id}", [
            'selected' => true,
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $answer = Answer::findOrFail($answer->id);
        $this->assertSame(true, $answer->selected);
    }

    public function test_답변수정_내용_수정_성공()
    {
        $answer = Answer::factory()->create();
        $user = $answer->user;
        $this->actingAs($user);

        $contentString = '수정할려는 내용';

        $response = $this->patch("/api/answers/{$answer->id}", [
            'content' => $contentString,
        ]);
        $response->assertStatus(Response::HTTP_OK);
        $answer = Answer::findOrFail($answer->id);
        $this->assertSame($contentString,$answer->content);
    }

    public function test_답변수정_채택된_답변_실패()
    {
        $answer = Answer::factory()->create(['selected'=>true]);
        $user = $answer->user;
        $this->actingAs($user);

        $contentString = '수정할려는 내용';

        $response = $this->patch("/api/answers/{$answer->id}", [
            'content' => $contentString,
        ]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_답변수정_자신이_작성한_답변이_아님_실패()
    {
        $answer = Answer::factory()->create(['selected'=>true]);
        $user = User::factory()->create();
        $this->actingAs($user);

        $contentString = '수정할려는 내용';

        $response = $this->patch("/api/answers/{$answer->id}", [
            'content' => $contentString,
        ]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
