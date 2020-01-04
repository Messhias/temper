<?php

/**
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    30/12/2019
 * @version  1.0
 */


namespace App\Traits;


use Illuminate\Http\JsonResponse;

/**
 * Trait to support the controllers and general classes to trait the errors and
 * remove the heavy load of facade Log library of the classes.
 *
 * Trait GenericLogErrors
 * @package App\Traits
 */
trait GenericLogErrors
{
    /**
     * Generic log error in the system into the system .logs
     *
     * @param mixed      $exception
     * @param mixed      $message
     *
     * @param int        $status
     *
     * @return JsonResponse
     */
    public function logError($exception, $message = null, int $status = 500): JsonResponse
    {
        error_log($exception);

        return response()->json([
            "success" => false,
            'error' => true,
            "data" => $exception,
            'message' => $message,
            "code" => $status,
        ], $status);
    }
}
