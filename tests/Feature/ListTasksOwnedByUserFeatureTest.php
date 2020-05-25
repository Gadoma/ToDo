<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListTasksOwnedByUserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * It can list tasks owned by the user
     *
     * @return void
     * @test
     */
    public function it_can_list_tasks_owned_by_user() : void
    {
        $user = factory(User::class)->create();
        $task = $user->tasks()->create(factory(Task::class)->raw());
        
        $response = $this->be($user, 'api')
            ->getJson('/api/v1/tasks');
        
        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => $task->title,
                'description' => $task->description,
                'user_id' => (string) $user->id,
            ]);
    }
}
