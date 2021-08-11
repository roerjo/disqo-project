<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function buildResponse(int $successStatus, object $result): JsonResponse
    {
        if ($result->hasError()) {
            return response()->json(
                ['error' => $result->getError()],
                400
            );
        }

        return response()->json($result->getSuccess(), $successStatus);
    }
}
