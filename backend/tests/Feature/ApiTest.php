<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_unauthenticated(): void
    {
        $response = $this->getJson('/api/files');

        $response->assertStatus(401);
    }
    public function test_authenticated(): void
    {

        // Registration
        $response = $this->post('/api/register', [
            'name' => 'my test name',
            'email' => 'phpunit@test.com',
            'password' => 'testpassword',
            'password_confirmation' => 'testpassword'
        ]);

        $response->assertStatus(200);

        // Getting all files of the user
        $token = $response->json('token');

        $filesResponse = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/files');


        $response = $this->getJson('/api/files', [
            'token' => $token
        ]);

        $response->assertStatus(200);

    }

}
