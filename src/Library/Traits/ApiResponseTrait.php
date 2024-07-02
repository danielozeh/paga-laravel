<?php

namespace DanielOzeh\Paga\Library\Traits;

use App\Exceptions\ServerException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

trait ApiResponseTrait
{
    /**
     * @throws RequestException
     */
    public static function checkForFailure(Response $response, $module): void
    {
        if ($response->serverError()) {
            throw new \Exception($response);
        }
        if ($response->clientError()) {
            \Log::error("$module --- " . $response->reason());
            $response->throw();
        }
    }

    public static function successResponse($message = 'Success', $data = null, $code = 200)
    {
        $res = [
            'status' => true,
            'message' => $message,
            'data' => $data,
            // 'code' => $code
        ];
        return json_encode($res);
    }

    public static function failureResponse($message = 'Error occurred. Please check back later', $code = 400)
    {
        $res = [
            'status' => false,
            'msg' => $message,
            // 'code' => $code
        ];
        return json_encode($res);
    }
}
