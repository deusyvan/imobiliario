<?php

namespace Laradev\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laradev\Http\Controllers\Controller;
use Laradev\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        /* $user = new User();
        $user->name = 'Deusyvan2';
        $user->email = 'deusyvan2@gmail.com';
        $user->document = '65805585121';
        $user->spouse_document = '65805585121';
        
        $user->password = bcrypt('teste');
        $user->save(); */
        //dd(Auth::check());
        if(Auth::check() === true){
          return redirect()->route('admin.home');  
        }
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
            $json['message'] = $this->message->error('Ooops, informe todos os dados para efetuar o login')->render();
            //retornando um json em response
            return response()->json($json);
        }
        //Verificar de fato é um e-mail válido
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json['message'] = $this->message->success('Ooops, informe um e-mail válido')->render();
            //retornando um json em response
            return response()->json($json); 
        }

        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password
        ];

        if(!Auth::attempt($credentials)){
            $json['message'] = $this->message->error('Ooops, usuário e senha não conferem')->render();
            return response()->json($json);
        }

        $this->authenticated($request->getClientIp());

        $json['redirect'] = route('admin.home');
        return response()->json($json);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    private function authenticated(string $ip)
    {
        $user = User::where('id', Auth::user()->id);
        $user->update([
            'last_login_at' => date('Y-m-d H:i:s'),
            'last_login_ip' => $ip
        ]);
    }
}
