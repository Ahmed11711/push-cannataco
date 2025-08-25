<?php

namespace App\Traits;

trait ApiResponseTrait
{

    public function successResponse($data = null, $message = '', $code = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }


    public function errorResponse($message = '', $code = 400, $errors = null)
    {
        $response = [
            'status'  => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
    public function emptySuccess($message = '', $code = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
        ], $code);
    }
}
