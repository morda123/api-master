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
    protected function jsonResponse($data, int $code = 200): JsonResponse
    {
        return response()->json($data, $code,
            [
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
