<?php

namespace App\Requests;

use App\Models\User;

final class ListTasksOwnedByUserRequest implements ListTasksOwnedByUserRequestInterface
{
    
    /** @var User */
    private User $user;

    /**
     * {@inheritdoc}
     */
    public function getUser() : User
    {
        return $this->user;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setUser(User $user) : void
    {
        $this->user = $user;
    }
}
