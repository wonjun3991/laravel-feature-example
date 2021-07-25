<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuestionDeleteTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;


    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_질문삭제_성공()
    {
        $this->expectException(ModelNotFoundException::class);
        $question = Question::factory()->create();
        $this->actingAs($question->user);

        $response = $this->delete("/api/questions/{$question->id}");
        $response->assertStatus(Response::HTTP_OK);

        //삭제되었는지 확인
        Question::findOrFail($question->id);
    }

    public function test_질문삭제_질문이_존재하지않음_실패()
    {
        $answer = Answer::factory()->create();
        $question = $answer->question;
        $this->actingAs($question->user);

        $response = $this->delete("/api/questions/{$question->id}");
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_질문삭제_답변이_존재_실패()
    {
        $answer = Answer::factory()->create();
        $question = $answer->question;
        $this->actingAs($question->user);

        $response = $this->delete("/api/questions/{$question->id}");
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    // 자신이 작성한 질문이 아니면 삭제 할 수 없다.
    public function test_질문삭제_권한이없음_실패()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->delete("/api/questions/{$question->id}");
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_질문삭제_존재하지않는질문_실패()
    {
        $isNotExistQuestionId = 12314124123;

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->delete("/api/questions/{$isNotExistQuestionId}");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_질문삭제_비로그인_실패()
    {
        $question = Question::factory()->create();

        $response = $this->delete("/api/questions/{$question->id}");
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
