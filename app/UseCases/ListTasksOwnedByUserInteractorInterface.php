<?php

namespace App\UseCases;

use App\Models\User;
use App\Requests\ListTasksOwnedByUserRequestInterface;
use App\Responses\ListTasksOwnedByUserResponseInterface;
use App\Repositories\TaskRepositoryInterface;

interface ListTasksOwnedByUserInteractorInterface
{

    /**
     * Run the use case and fetch the user's tasks
     *
     * @param ListTasksOwnedByUserRequestInterface $request
     * @return ListTasksOwnedByUserResponseInterface
     */
    public function run(ListTasksOwnedByUserRequestInterface $request) : ListTasksOwnedByUserResponseInterface;
}
