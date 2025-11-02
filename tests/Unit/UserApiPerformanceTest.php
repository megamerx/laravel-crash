<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserApiPerformanceTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed some sample users for testing
        User::factory()->count(100)->create();
    }

    /**
     * Measure the response time of the GET /api/users endpoint.
     */
    public function test_users_index_performance()
    {
        $start = microtime(true);

        $response = $this->getJson('/api/users');

        $duration = microtime(true) - $start;

        $response->assertStatus(200);

        // Print or log duration for reference
        fwrite(STDOUT, "\nGET /api/users took {$duration} seconds\n");

        // Set a threshold (example: should respond under 500 ms)
        $this->assertLessThan(0.5, $duration, 'User index API is too slow.');
    }

    /**
     * Test POST /api/users creation performance.
     */
    public function test_user_creation_performance()
    {
        $email = 'speedtest@example.com';
        $username = str_replace(['@', '.'], ['-','-'] , $email) . str_pad(random_int(0, 1000), 4, "0", STR_PAD_LEFT);
        $payload = [
            'name' => 'Speed Test User',
            'email' => $email,
            'password' => 'password123',
            'username' => $username,
        ];

        $start = microtime(true);

        $response = $this->postJson('/api/users', $payload);
        $message = isset($response->json()['message']) ? $response->json()['message'] : $response->json();
        // $this->print_debug([$payload, $response->status(), $message]);

        $duration = microtime(true) - $start;

        $response->assertStatus(201);

        fwrite(STDOUT, "\nPOST /api/users took {$duration} seconds\n");

        $this->assertLessThan(0.5, $duration, 'User creation API is too slow.');
    }

    /**
     * Test GET /api/users/{id} for speed.
     */
    public function test_user_show_performance()
    {
        $user = User::first();

        $start = microtime(true);

        $response = $this->getJson("/api/users/{$user->id}");

        $duration = microtime(true) - $start;

        $response->assertStatus(200);

        fwrite(STDOUT, "\nGET /api/users/{$user->id} took {$duration} seconds\n");

        $this->assertLessThan(0.3, $duration, 'User show API is too slow.');
    }

    function print_debug($var) {
        fwrite(STDOUT, print_r($var, true));
    }
}
