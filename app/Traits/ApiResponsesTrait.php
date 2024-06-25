<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Response;

trait ApiResponsesTrait
{
    public function success($data = [], $message = 'data found successfully', $code = 200) : JsonResponse {

        $response = [
            'data' => $data,
            'success' => true,
            'message' => $message,
        ];
        return Response::json($response, $code);
    }

    public function error($message = 'Error Occurred', $code = 200, $data = []) : JsonResponse {

        $response = [
            'data' => $data,
            'success' => false,
            'message' => $message,
        ];
        return Response::json($response, $code);
    }
}
