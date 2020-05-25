<?php

namespace App\Responses;

use Illuminate\Support\Collection;

use App\Models\Task;

final class ListTasksOwnedByUserResponse implements ListTasksOwnedByUserResponseInterface
{
    
    /** @var Collection */
    private Collection $tasks;

    /**
     * {@inheritdoc}
     */
    public function getTasks() : Collection
    {
        return $this->tasks;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTasks(Collection $tasks) : void
    {
        $this->tasks = $tasks;
    }
}
