<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;

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

    /**
     * It can only list tasks that are not completed
     *
     * @return void
     * @test
     */
    public function it_can_list_only_not_completed_tasks() : void
    {
        $user = factory(User::class)->create();
        
        $taskNotDone = factory(Task::class)->create();
        $taskDone = factory(Task::class)->create();
        $taskDone->completed_at = Carbon::yesterday();

        $user->tasks()->save($taskDone);
        $user->tasks()->save($taskNotDone);
        
        $response = $this->be($user, 'api')
            ->getJson('/api/v1/tasks');
        
        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => $taskNotDone->title,
                'description' => $taskNotDone->description,
                'user_id' => (string) $user->id,
            ])
            ->assertJsonMissing([
                'title' => $taskDone->title,
                'description' => $taskDone->description,
            ]);
    }

    /**
     * It can only list tasks for today or without date
     *
     * @return void
     * @test
     */
    public function it_can_list_only_tasks_for_today_or_without_date() : void
    {
        $user = factory(User::class)->create();
        
        $task = factory(Task::class)->create();
        $taskToday = factory(Task::class)->create();
        $taskYesterday = factory(Task::class)->create();
        $taskTomorrow = factory(Task::class)->create();
        
        $taskToday->planned_at = Carbon::today();
        $taskYesterday->planned_at = Carbon::yesterday();
        $taskTomorrow->planned_at = Carbon::tomorrow();

        $user->tasks()->save($task);
        $user->tasks()->save($taskToday);
        $user->tasks()->save($taskYesterday);
        $user->tasks()->save($taskTomorrow);
        
        $response = $this->be($user, 'api')
            ->getJson('/api/v1/tasks');
        
        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => $task->title,
                'description' => $task->description,
                'user_id' => (string) $user->id,
            ])
            ->assertJsonFragment([
                'title' => $taskToday->title,
                'description' => $taskToday->description,
                'user_id' => (string) $user->id,
            ])
            ->assertJsonMissing([
                'title' => $taskYesterday->title,
                'description' => $taskYesterday->description,
            ])
            ->assertJsonMissing([
                'title' => $taskTomorrow->title,
                'description' => $taskTomorrow->description,
            ]);
    }
}
