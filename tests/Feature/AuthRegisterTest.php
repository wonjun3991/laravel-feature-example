<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthRegisterTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_회원가입_성공()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '멘토',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '흰색',
            'age' => 15
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function test_회원가입_중복된_이메일()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '멘토',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '흰색',
            'age' => 15
        ]);
        $response->assertStatus(Response::HTTP_CREATED);

        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '멘토',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '흰색',
            'age' => 15
        ]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }

    public function test_회원가입_존재하지_않는_고양이_종류_실패()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '멘토',
            'cat_type' => '존재하지 않는 고양이 종류',
            'cat_pattern_type' => '흰색',
            'age' => 15
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_회원가입_존재하지_않는_고양이_무늬_종류_실패()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '멘토',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '존재하지 않는 고양이 무늬 종류',
            'age' => 15
        ]);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }


    public function test_회원가입_올바르지_않은_유저_종류_실패()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '존재하지 않는 유저 종류',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '흰색',
            'age' => 15
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_회원가입_나이제한_실패()
    {
        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '존재하지 않는 유저 종류',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '흰색',
            'age' => 17
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response = $this->post('/api/auth/register', [
            'email' => 'test@naver.com',
            'password' => 'test1234',
            'type' => '존재하지 않는 유저 종류',
            'cat_type' => '터키쉬 앙고라',
            'cat_pattern_type' => '흰색',
            'age' => 0
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
