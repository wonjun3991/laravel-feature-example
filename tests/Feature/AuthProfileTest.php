<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthProfileTest extends TestCase
{
    //기존에 존재하는 데이터베이스 데이터 초기화
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders(['Accept' => 'application/json']);
    }

    public function test_개인정보_성공()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/api/auth/profile');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data'=>[
                'id',
                'age',
                'cat_pattern_type',
                'cat_type',
                'type'
            ]
        ]);
    }

    public function test_개인정보_실패()
    {
        $response = $this->get('/api/auth/profile');
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

}
