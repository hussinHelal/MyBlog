<?php

namespace App;

trait ApiResponce
{
    public function apiResponce($query=NULL, $msg=NULL, $status=NULL)
    {

        return response($query,$msg,$status);
    }
}
