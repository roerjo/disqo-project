<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\RegisterRequest;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Controllers\API\V1\RegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        //
    }
}
