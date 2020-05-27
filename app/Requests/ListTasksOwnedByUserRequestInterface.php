<?php

namespace App\Requests;

use App\Models\User;

interface ListTasksOwnedByUserRequestInterface
{
    
    /**
     * User getter
     * @return User
     */
    public function getUser() : User;
    
    /**
     * User setter
     * @param User $user
     * @return void
     */
    public function setUser(User $user) : void;
}
