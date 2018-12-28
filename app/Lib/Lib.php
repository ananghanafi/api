<?php

namespace App\Lib;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Route;
use URL;
use Request;
use Auth;
use Response;

class Lib {
    public static function sendData($data=[]){ 
        return Response::json($data, 200);
    }
    
    public static function sendError($message="error",$code = 400){ 
        return Response::json(['message'=>$message], $code);
    }
    public static function getExpiredCache(){
        $minute = config('apilib.cache_minute');
        return Carbon::now()->addMinutes($minute);
    }
}