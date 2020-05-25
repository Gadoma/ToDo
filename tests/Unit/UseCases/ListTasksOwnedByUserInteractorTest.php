<?php

namespace Tests\Unit\UseCases;

use App\Requests\ListTasksOwnedByUserRequestInterface;
use App\Responses\ListTasksOwnedByUserResponseInterface;
use App\Repositories\TaskRepositoryInterface;

use App\UseCases\ListTasksOwnedByUserInteractor;

use PHPUnit\Framework\TestCase;
use Mockery;

class ListTasksOwnedByUserInteractorTest extends TestCase
{
    /**
     * Checks if the use case acts as expected
     *
     * @return void
     * @test
     */
    public function it_runs_and_returns_tasks()
    {
        $requestMock = $this->getRequestMock();
        $responseMock = $this->getResponseMock();
        $taskRepoMock = $this->getTaskRepositoryMock();

        $useCase = new ListTasksOwnedByUserInteractor($taskRepoMock, $responseMock);

        $expected = $responseMock;
        $actual = $useCase->run($requestMock);

        $this->assertEquals($actual, $expected);

        unset($requestMock);
        unset($responseMock);
        unset($taskRepoMock);
    }

    /**
     * Mock the request DTO
     * @return ListTasksOwnedByUserRequestInterface
     */
    private function getRequestMock()
    {
        $mock = \Mockery::mock(ListTasksOwnedByUserRequestInterface::class);
        $mock->shouldReceive('getUser')->once();
        return $mock;
    }

    /**
     * Mock the response DTO
     * @return ListTasksOwnedByUserResponseInterface
     */
    private function getResponseMock()
    {
        $mock = \Mockery::mock(ListTasksOwnedByUserResponseInterface::class);
        $mock->shouldReceive('setTasks')->once()->with(Mockery::any());
        return $mock;
    }

    /**
     * Mock the Task repository
     * @return TaskRepositoryInterface
     */
    private function getTaskRepositoryMock()
    {
        $mock =\Mockery::mock(TaskRepositoryInterface::class);
        $mock->shouldReceive('getTasksOfUser')->once()->with(Mockery::any());
        return $mock;
    }
}
