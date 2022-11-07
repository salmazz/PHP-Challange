<?php

namespace App\Traits;

trait ResponseTrait
{
    protected function response($data = [], $status = true, $message = '', $code = '')
    {
        $data = [
            'payload' => $data,
            'status' => $status,
            'message' => $message,
            'code' => $code
        ];
        return response()->json($data);
    }
}
