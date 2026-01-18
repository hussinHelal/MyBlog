<?php

namespace App;

trait ApiResponce
{
    public function apiResponce($data=NULL, $msg=NULL, $status=200)
    {
         return response()->json([
            'data' => $data,
            'message' => $msg,
        ], $status);
    }
}
