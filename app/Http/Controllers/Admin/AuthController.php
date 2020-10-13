<?php

namespace Laradev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laradev\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.index');
    }

    public function home()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        //Tratando somente email e password
        if(in_array('',$request->only('email','password'))){
            $json['message'] = "Ooops, informe todos os dados para efetuar o login";
            //retornando um json em response
            return response()->json($json);
        }
        var_dump($request->all());
    }
}
