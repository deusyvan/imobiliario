<?php

namespace Laradev\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laradev\Http\Controllers\Controller;
use Laradev\Http\Requests\Admin\User as UserRequest;
use Laradev\Support\Cropper;
use Laradev\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',[
            'users' => $users
        ]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        //Busca apenas os usuários que são administradores
        $users = User::where('admin',1)->get();
        return view('admin.users.team',[
            'users' => $users
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //Persiste os dados no banco de dados
        $userCreate = User::create($request->all());

        if(!empty($request->file('cover'))){
            //Aqui: Storage define pra onde é jogado a imagem e em cover onde é salvo o nome da imagem  
            $userCreate->cover = $request->file('cover')->store('user');
            $userCreate->save();
        }

        return redirect()->route('admin.users.edit',[
            'users' => $userCreate->id
        ])->with(['color' => 'green', 'message' => 'Cliente cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        //var_dump($user->document,$user->date_of_birth,$user->income,$user->spouse_document,$user->spouse_date_of_birth,$user->spouse_income,$user->getAttributes());
        return view('admin.users.edit',[
            'user' => $user
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::where('id',$id)->first();

        $user->setLessorAttribute($request->lessor);
        $user->setLesseeAttribute($request->lessee);

        if(!empty($request->file('cover'))){
            //Prevenir caso não salvar, elimine o upload, elimando o que tinha no banco de dados e no diretorio
            Storage::delete($user->cover);
            //Limpando o diretorio cache onde é carregado os thumbnails
            Cropper::flush($user->cover);
            $user->cover = '';//Tornando o dado vazio
        }
        //Com o fill alimenta os dados com os do formulário
        $user->fill($request->all());

        if(!empty($request->file('cover'))){
            //Aqui: Storage define pra onde é jogado a imagem e em cover onde é salvo o nome da imagem  
            $user->cover = $request->file('cover')->store('user');
        }

        if(!$user->save()){
            //Se não conseguir salvar retorna com a msg de erro e os dados do form
            return redirect()->back()->withInput()->withErrors($this);
        }

        return redirect()->route('admin.users.edit',[
            'users' => $user->id
        ])->with(['color' => 'green', 'message' => 'Cliente atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
