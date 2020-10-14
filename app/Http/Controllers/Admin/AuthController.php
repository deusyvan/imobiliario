<?php

namespace Laradev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laradev\Http\Controllers\Controller;
use Laradev\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $user = User::where('id',1)->first();
        $user->password = bcrypt('teste');
        $user->save();
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
            $json['message'] = $this->message->success('Ooops, informe todos os dados para efetuar o login')->render();
            //retornando um json em response
            return response()->json($json);
        }
        //Verificar de fato é um e-mail válido
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json['message'] = $this->message->success('Ooops, informe um e-mail válido')->render();
            //retornando um json em response
            return response()->json($json); 
        }
        var_dump($request->all());
    }
}
