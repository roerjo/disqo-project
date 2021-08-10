<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Controllers\API\V1\RegisterRequest  $request
     * @param  \App\Services\UserService  $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(
        RegisterRequest $request, 
        UserService $userService
    ): JsonResponse {
        $result = $userService->registerUser($request->validated());

        if ($result->hasError()) {
            return response()->json(
                ['error' => $result->getError()],
                400
            );
        }

        return response()->json($result->getSuccess(), 201);
    }
}
