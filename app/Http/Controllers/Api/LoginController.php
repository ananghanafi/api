<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllerTrait;
use Auth;
use Validator;
use App\User;


class LoginController extends Controller
{
    use ControllerTrait;
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Username dan Password tidak sesuai');
        }
        if(!Auth::attempt(['email' => $request->username, 'password' => $request->password])){
            return $this->sendError('username dan password tidak sesuai');
        }
       
        $user = Auth::user()->makeVisible('api_token');
        return $this->sendData($user);
    }
    
    public function create(Request $request)
    {
        
    }
    
    public function me(Request $request)
    {
        $user = Auth::user();
        return $this->sendData($user);
    }
}
