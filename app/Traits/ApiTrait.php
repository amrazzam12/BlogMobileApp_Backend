<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiTrait{


    public function returnError($msg = 'No Data'): JsonResponse
    {
        return response()->json([
            'Status' => "Failed" ,
            'Message' => $msg
        ]);
    }


    public function returnSuccess($msg = "Done Successfully"): JsonResponse
    {
        return response()->json([
            'Status' => 'Success',
            'Message' => $msg
        ]);
    }

    public function returnData($status, $msg , $value): JsonResponse
    {
        return response()->json([
            'Status' => $status,
            'Message' => $msg,
            "data" => $value
        ]);
    }

}
