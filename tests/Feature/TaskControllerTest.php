<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use App\Models\Task;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        return $token;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $token = $this->authenticate();

        // Set the Authorization header with the JWT token for all requests
        $this->withHeader('Authorization', 'Bearer ' . $token);
    }

    /**
     * Test retrieving a list of tasks.
     *
     * @return void
     */
    public function test_index()
    {
        // Create tasks
        Task::factory()->count(5)->create();

        // Make request to index endpoint
        $response = $this->get('/api/task');

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response contains the correct number of tasks
        $response->assertJsonCount(5, 'data');

        // Assert response structure
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'completion_date',
                    'status',
                    'user_id',
                    'user',
                    'created_at',
                ]
            ]
        ]);
    }

    /**
     * Test retrieving a single task.
     *
     * @return void
     */
    public function test_show()
    {
        // Create a task
        $task = Task::factory()->create();

        // Make request to show endpoint
        $response = $this->get("/api/task/{$task->id}");

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response structure
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'completion_date',
                'status',
                'user_id',
                'user',
                'created_at',
            ]
        ]);
    }

    /**
     * Test creating a new task.
     *
     * @return void
     */
    public function test_store()
    {
        // Task data
        $data = [
            'name' => 'test name',
            'description' => 'test desc',
            'completion_date' => null,
            'status' => 'new',
            'user_id' => 1,
        ];

        // Make request to store endpoint
        $response = $this->postJson('/api/task', $data);

        // Assert response status is 200
        $response->assertStatus(200);

        \Illuminate\Support\Facades\Log::info('Response content: ' . $response->getContent());
        // Assert response structure
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'completion_date',
            'status',
            'user_id',
        ]);
    }

    /**
     * Test updating an existing task.
     *
     * @return void
     */
    public function test_update()
    {
        // Create a task
        $task = Task::factory()->create();

        // Updated task data
        $data = [
            'name' => 'test name',
            'description' => 'test desc',
            'completion_date' => null,
            'status' => 'new',
            'user_id' => 1,
        ];

        // Make request to update endpoint
        $response = $this->putJson("/api/task/{$task->id}", $data);

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response structure
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'completion_date',
            'status',
            'user_id',
        ]);
    }

    /**
     * Test deleting a task.
     *
     * @return void
     */
    public function test_destroy()
    {
        // Create a task
        $task = Task::factory()->create();

        // Make request to destroy endpoint
        $response = $this->delete("/api/task/{$task->id}");

        // Assert response status is 204 (no content)
        $response->assertStatus(204);

    }
}
