<?php

namespace App\Traits ;

trait ResponseApiTrait
{
    public function successApi($data = null , $msg = null , $status)
    {
        return response()->json([
            'Msg' => $msg ,
            'data' => $data ,
        ] , $status) ;
    }

    public function FaildApi($msg , $status)
    {
        return response()->json([
            'Msg' => $msg ,
        ] , $status) ;
    }

    public function DeleteApi($msg , $status)
    {
        return response()->json([
            'Msg' => $msg ,
        ] , $status) ;
    }

    public function getDataApi($data , $status)
    {
        return response()->json([
            'data' => $data ,
        ] , $status) ;
    }
}
