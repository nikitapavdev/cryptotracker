<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GuardTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_connectToGuard(): void
    {
        Http::fake([
            'http://fileguard:8000/secure' => Http::response(['message' => 'ok'], 200)
        ]);

        $response = Http::post('http://fileguard:8000/secure', [
            'path' => 'test',
            'callback_url' => 'test.test'
        ]);

        $this->assertEquals(200, $response->status()); 
        
    }
}
