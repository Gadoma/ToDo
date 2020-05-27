<?php

namespace App\UseCases;

use App\Models\User;
use App\Requests\ListTasksOwnedByUserRequestInterface;
use App\Responses\ListTasksOwnedByUserResponseInterface;
use App\Repositories\TaskRepositoryInterface;

final class ListTasksOwnedByUserInteractor implements ListTasksOwnedByUserInteractorInterface
{
    /** @var TaskRepositoryInterface */
    private TaskRepositoryInterface $taskRepo;

    /** @var ListTasksOwnedByUserResponseInterface */
    private ListTasksOwnedByUserResponseInterface $response;
    
    /**
     * Create object
     *
     * @param TaskRepositoryInterface $taskRepo
     * @param ListTasksOwnedByUserResponseInterface $response
     * @return self
     */
    public function __construct(TaskRepositoryInterface $taskRepo, ListTasksOwnedByUserResponseInterface $response)
    {
        $this->taskRepo =  $taskRepo;
        $this->response =  $response;
    }

    /**
     * {@inheritdoc}
     */
    public function run(ListTasksOwnedByUserRequestInterface $request) : ListTasksOwnedByUserResponseInterface
    {
        $user = $request->getUser();
    
        $tasks = $this->taskRepo->getTasksOfUser($user);
    
        $this->response->setTasks($tasks);

        return $this->response;
    }
}
