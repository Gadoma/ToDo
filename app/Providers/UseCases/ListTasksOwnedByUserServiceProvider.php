<?php

namespace App\Providers\UseCases;

use Illuminate\Support\ServiceProvider;

use App\Models\Task;
use App\Models\User;

use App\Requests\ListTasksOwnedByUserRequestInterface;
use App\Requests\ListTasksOwnedByUserRequest;
use App\Responses\ListTasksOwnedByUserResponseInterface;
use App\Responses\ListTasksOwnedByUserResponse;
use App\Repositories\TaskRepositoryInterface;
use App\Repositories\TaskRepository;
use App\UseCases\ListTasksOwnedByUserInteractorInterface;
use App\UseCases\ListTasksOwnedByUserInteractor;

class ListTasksOwnedByUserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ListTasksOwnedByUserRequestInterface::class, function () {
            return new ListTasksOwnedByUserRequest();
        });
        
        $this->app->bind(ListTasksOwnedByUserResponseInterface::class, function () {
            return new ListTasksOwnedByUserResponse();
        });

        $this->app->bind(TaskRepositoryInterface::class, function () {
            return new TaskRepository($this->app->make(Task::class));
        });

        $this->app->bind(ListTasksOwnedByUserInteractorInterface::class, function () {
            return new ListTasksOwnedByUserInteractor($this->app->make(TaskRepositoryInterface::class), $this->app->make(ListTasksOwnedByUserResponseInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
