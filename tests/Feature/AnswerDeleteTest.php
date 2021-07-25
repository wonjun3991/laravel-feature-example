<?php

namespace Tests\Feature;

use App\Models\Answer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AnswerDeleteTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;


    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_답변삭제_성공()
    {
        $this->expectException(ModelNotFoundException::class);

        $answer = Answer::factory()->create();
        $user = $answer->user;
        $this->actingAs($user);

        $response = $this->delete("/api/answers/{$answer->id}");
        $response->assertStatus(Response::HTTP_OK);
        Answer::findOrFail($answer->id);
    }


    public function test_답변삭제_채택된_답변_실패()
    {
        $answer = Answer::factory()->create(['selected' => true]);
        $user = $answer->user;
        $this->actingAs($user);

        $response = $this->delete("/api/answers/{$answer->id}");
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_답변삭제_자신이_작성한_답변만_삭제가능_실패()
    {
        $answer = Answer::factory()->create();
        $user = $answer->question->user;
        $this->actingAs($user);

        $response = $this->delete("/api/answers/{$answer->id}");
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
