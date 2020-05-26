<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Collection;

use Carbon\Carbon;

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
        return $this->model->where(['user_id' => $user->id, 'completed_at' => null])->where(function ($query) {
            $query->where('planned_at', '=', Carbon::today())
                  ->orWhereNull('planned_at');
        })->get();
    }
}
