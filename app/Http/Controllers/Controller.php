<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * success response method.
     *
     * @param $result
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function sendResponse($result, string $message = 'ok', int $code = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($result !== null) {
            $response['data'] = $result;
        }

        if ($code == 0) {
            $code = 500;
        }

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @param string $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError(string $error, array $errorMessages = [], int $code = 404): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        if ($code == 0) {
            $code = 500;
        }

        return response()->json($response, $code);
    }

    /**
     * @return JsonResponse|Authenticatable
     * @throws AuthenticationException
     */
    protected function getUser(): \Illuminate\Http\JsonResponse|\Illuminate\Contracts\Auth\Authenticatable
    {
        $user = auth()->user();
        if (!$user) {
            throw new AuthenticationException();
        }
        return $user;
    }
}
