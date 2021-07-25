<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthLogoutTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_로그아웃_성공()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/api/auth/logout');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_로그아웃_실패()
    {
        $response = $this->post('/api/auth/logout');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

}
