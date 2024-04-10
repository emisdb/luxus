<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if login endpoint returns a valid JWT token.
    * @return void
     */
    public function test_login_endpoint_returns_valid_token()
    {
        // Create a test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Prepare request data
        $requestData = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        // Send a POST request to the login endpoint
        $response = $this->postJson('/api/auth/login', $requestData);

        // Assert response status code is 200
        $response->assertStatus(200);

        // Assert response contains the expected structure
        $response->assertJsonStructure([
            'token',
            'token_type',
            'expires_in'
        ]);

        // Assert the token type is "bearer"
        $response->assertJsonFragment(['token_type' => 'bearer']);

    }
    /**
     * Test refreshing a token.
     *
     * @return void
     */
    public function test_refreshing_token()
    {
        // Create a user and authenticate
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $token = auth('api')->login($user);

        // Call the refresh endpoint
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/auth/refresh');

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the response contains the token type
        $response->assertJsonFragment(['token_type' => 'bearer']);

        // Assert the response contains the token
        $response->assertJsonStructure(['token']);

        // Assert the response contains the expiry time
        $response->assertJsonStructure(['expires_in']);
    }
}
