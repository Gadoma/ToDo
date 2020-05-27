<?php

namespace App\Responses;

use Illuminate\Support\Collection;

interface ListTasksOwnedByUserResponseInterface
{
    
    /**
     * Task collection getter
     * @return Collection
     */
    public function getTasks() : Collection;
    
    /**
     * Task collection setter
     * @param Collection $tasks
     * @return void
     */
    public function setTasks(Collection $tasks) : void;
}
