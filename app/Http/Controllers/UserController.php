<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = User::paginate(10);
        return view('users.index', compact('models'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->password != $request->passwordconfirm) {
            notify()->error('Senhas não conferem!');
            return redirect()->back()->withInput();
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        notify()->success('Usuário inserido com sucesso!');
        return redirect()->route('user.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show' . $id);
        $user = User::find($id);
        if (empty($user)) {
            notify()->error("Usuário não encontrado !!");
            return redirect()->route('user.index');
        }
        return view('users.edit', compact($user));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //dd($request->user()->id);
        if ($request->user()->id != $id && $request->user()->id != 1) {
            notify()->error("SEM PERMISSÃO para alterar esse usuário!!");
            return redirect()->route('user.index');
        }
        $user = User::find($id);
        if (empty($user)) {
            notify()->error("Usuário não encontrado !!");
            return redirect()->route('user.index');
        }
        return view('users.edit', compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->user()->id != $id && $request->user()->id != 1) {
            notify()->error("SEM PERMISSÃO para alterar esse usuário!!");
            return redirect()->route('user.index');
        }
        $user  = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)) {
            if ($request->password !== $request->passwordconfirm) {
                notify()->error("As senhas digitadas não são iguais!!");
                return redirect()->back();
            }
            $user->password = bcrypt($request->password);
        }
        $user->save();
        notify()->success('Usuário alterado com sucesso!');
        return redirect()->route('user.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->user()->id != 1) {
            notify()->error("DELEÇÃO NEGADA !!!!");
            return redirect()->route('user.index');
        }
        try {
            $user = User::find($id);
            $user->delete();
        } catch (\Exception $e) {
            notify()->error("DELEÇÃO Não realizada! Este usuário tem projetos cadastrados.");
            return redirect()->route('user.index');
        }
        notify()->success('Usuário removido!');
        return redirect()->route('user.index');
    }
}
