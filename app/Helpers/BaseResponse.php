<?php

namespace App\Helpers;

class BaseResponse
{
  public static function success($data = null, $message = 'Success', $statusCode = 200)
  {
    return response()->json([
      'success' => true,
      'message' => $message,
      'data' => $data
    ], $statusCode);
  }

  public static function error($message = 'Something went wrong', $statusCode = 400)
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'data' => null
    ], $statusCode);
  }

  public static function notFound($message = 'Resource not found')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'data' => null
    ], 404);
  }

  public static function unauthorized($message = 'Unauthorized access')
  {
    return response()->json([
      'success' => false,
      'message' => $message,
      'data' => null
    ], 401);
  }
}
