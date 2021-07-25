<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuestionStoreTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_질문작성_성공()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/questions', [
            'question_type' => '사료',
            'title' => '냥냥펀치때려도되나요.',
            'content' => '존나때리세요.'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_질문작성_올바르지않은_질문타입_실패()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/questions',
            [
                'question_type' => '올바르지않은 질문 타입',
                'title' => '냥냥펀치때려도되나요.',
                'content' => '존나때리세요.'
            ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_질문작성_제목없음_실패()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/questions', [
            'title' => '냥냥펀치때려도되나요.',
            'content' => '존나때리세요.'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_질문작성_질문유형없음_실패()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/questions', [
            'question_type' => '사료',
            'content' => '존나때리세요.'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_질문작성_내용없음_실패()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/questions', [
            'question_type' => '사료',
            'title' => '냥냥펀치때려도되나요.',
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_질문작성_비회원_실패()
    {
        $response = $this->post('/api/questions', [
            'question_type' => '사료',
            'content' => '존나때리세요.'
        ]);
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
