<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    public function __constructor()
    {
        //no requiere autenticación
        $this->middleware(['guest']);
    }

    public function login(LoginRequest $request)
    {
        if(!auth()->guard()->attempt($request->only('email', 'password'))){
            throw new AuthenticationException();
        }
    }
}
