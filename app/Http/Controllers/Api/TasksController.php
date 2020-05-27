<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Requests\ListTasksOwnedByUserRequestInterface;
use App\UseCases\ListTasksOwnedByUserInteractorInterface;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $httpRequest
     * @param ListTasksOwnedByUserRequestInterface $dto
     * @param ListTasksOwnedByUserInteractorInterface $useCase
     * @return JsonResponse
    */
    public function index(Request $httpRequest, ListTasksOwnedByUserRequestInterface $dto, ListTasksOwnedByUserInteractorInterface $useCase) : JsonResponse
    {
        $user = $httpRequest->user();

        $dto->setUser($user);

        $response = $useCase->run($dto);

        return response()->json($response->getTasks());
    }
}
