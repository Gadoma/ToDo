<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    /** @var Task */
    private Task $model;

    /**
     * Creates the repository
     *
     * @param Task $model
     * @return self
     */
    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getTasksOfUser(User $user) : Collection
    {
        return $this->model->where(['user_id' => $user->id])->get();
    }
}
