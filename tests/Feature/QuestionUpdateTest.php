<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuestionUpdateTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_질문수정_제목_수정_성공()
    {
        $question = Question::factory()->create();
        $this->actingAs($question->user);

        $titleString = '냥냥펀치 많이때려도 되나요?';

        //title 만 변경했을 경우
        $response = $this->patch("/api/questions/{$question->id}", [
            'title' => $titleString,
        ]);
        $question = Question::find($question->id);
        $this->assertSame($titleString, $question->title);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_질문수정_내용_수정_성공()
    {
        $question = Question::factory()->create();
        $this->actingAs($question->user);

        $contentString = '냥냥펀치 존나 많이때려도 됩니다.';

        //content 만 변경했을 경우
        $response = $this->patch("/api/questions/{$question->id}", [
            'content' => $contentString,
        ]);
        $question = Question::find($question->id);
        $this->assertSame($contentString, $question->content);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_질문수정_질문_타입_수정_성공()
    {
        $question = Question::factory()->create();
        $this->actingAs($question->user);

        $questionType = '집사 후기';
        //question_type 만 변경했을 경우
        $response = $this->patch("/api/questions/{$question->id}", [
            'question_type' => $questionType,
        ]);
        $question = Question::find($question->id);
        $this->assertSame($questionType, $question->questionType->type);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_질문수정_올바르지않은_질문타입_실패()
    {
        $question = Question::factory()->create();
        $this->actingAs($question->user);

        $response = $this->patch("/api/questions/{$question->id}", [
            'question_type' => '올바르지않은 질문 타입',
            'title' => '냥냥펀치때려도되나요.',
            'content' => '존나때리세요.',
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_질문수정_존재하지_않는_질문_실패()
    {
        $isNotExistQuestionId = 12314124123;

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->patch("/api/questions/{$isNotExistQuestionId}", [
            'title' => '냥냥펀치때려도되나요.',
            'content' => '존나때리세요.',
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_질문수정_권한없음_실패()
    {
        $question = Question::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->patch("/api/questions/{$question->id}", [
            'question_type' => '사료',
            'title' => '냥냥펀치때려도되나요.',
            'content' => '존나때리세요.'
        ]);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    public function test_질문수정_비로그인_실패()
    {
        $question = Question::factory()->create();

        $response = $this->patch("/api/questions/{$question->id}", [
            'question_type' => '사료',
            'title' => '냥냥펀치때려도되나요.',
            'content' => '존나때리세요.'
        ]);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
