<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    public function test_유저리스트조회()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->dump();
    }

    public function test_유저생성()
    {
        $response = $this->post('/api/users', [
            'email' => 'aa3991@naver.com',
            'password' => 'sh0964',
            'type' => '멘토',
            'catType' => '터키쉬 앙고라',
            'catPatternType' => '흰색',
            'age' => 15
        ]);
        $response->dump();
        $response->assertStatus(Response::HTTP_CREATED);

    }

}
