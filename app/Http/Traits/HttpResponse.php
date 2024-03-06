<?php

namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

class HttpResponse
{

    public static function error($message, $errors = [], $code = 401)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['data'] = $errors;
        }

        throw new HttpResponseException(response()->json($response, $code));
    }
}