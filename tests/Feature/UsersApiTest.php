<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class UsersApiTest extends TestCase
{
    public function test_로그인유저_유저리스트조회()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
        $response->dump();
    }

    public function test_로그인유저_유저조회()
    {

    }

    public function test_비로그인유저_유저리스트조회()
    {

    }

    public function test_비로그인유저_유저조회()
    {

    }
}
