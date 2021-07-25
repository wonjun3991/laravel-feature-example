<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_로그인_성공()
    {
        $user = User::factory()->create([
            'password' => Hash::make('test')
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'test'
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_로그인_올바르지않은비밀번호_실패()
    {
        $user = User::factory()->create([
            'password' => Hash::make('test')
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => '올바르지않은비밀번호'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_로그인_올바르지않은이메일_실패()
    {
        $user = User::factory()->create([
            'password' => Hash::make('test')
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => 'test@google.com',
            'password' => 'test'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
