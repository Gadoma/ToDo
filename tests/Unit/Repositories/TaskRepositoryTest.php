<?php

namespace Tests\Unit\Repositories;

use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\Collection;

use PHPUnit\Framework\TestCase;
use Mockery;

class TaskRepositoryTest extends TestCase
{
    /**
     * Checks if the repository returns the user tasks collection
     *
     * @return void
     * @test
     */
    public function it_returns_user_tasks_collection() : void
    {
        $taskMock = $this->getTaskMock();
        $expected = collect([$taskMock]);
        $taskMock->shouldReceive('get')->once()->andReturn($expected);

        $userMock = $this->getUserMock();

        $repo = new TaskRepository($taskMock);
        $actual = $repo->getTasksOfUser($userMock);

        $this->assertEquals($actual, $expected);

        unset($taskMock);
        unset($userMock);
    }

    /**
     * Checks if the repository returns an empty collection if there is no tasks
     *
     * @return void
     * @test
     */
    public function it_returns_empty_collection_if_no_tasks() : void
    {
        $taskMock = $this->getTaskMock();
        $expected = collect([]);
        $taskMock->shouldReceive('get')->once()->andReturn($expected);

        $userMock = $this->getUserMock();

        $repo = new TaskRepository($taskMock);
        $actual = $repo->getTasksOfUser($userMock);

        $this->assertEquals($actual, $expected);

        unset($taskMock);
        unset($userMock);
    }

    /**
     * Mock the Task model
     * @return Task
     */
    private function getTaskMock() : Task
    {
        $mock = \Mockery::mock(Task::class);
        $mock->shouldReceive('where')->twice()->with(Mockery::any())->andReturnSelf();
        return $mock;
    }

    /**
    * Mock the User model
    * @return User
    */
    private function getUserMock() : User
    {
        $mock = \Mockery::mock(User::class);
        $mock->shouldReceive('getAttribute')->once()->with('id');
        return $mock;
    }
}
