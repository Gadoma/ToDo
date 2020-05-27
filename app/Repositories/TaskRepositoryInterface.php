<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    /**
     * Get Tasks of the given User
     *
     * @param User $user
     * @return Collection
     */
    public function getTasksOfUser(User $user) : Collection;
}
