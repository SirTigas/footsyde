<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:1|max:10',
            'last_name' => 'required|min:1|max:10',
            'email' => 'required|email',
            'password' => 'required|min:4|max:8'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório!',

            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O nome deve ter no máximo 10 caracteres',

            'last_name.max' => 'O Sobrenome deve ter no máximo 10 caracteres',
            'last_name.min' => 'O Sobrenome deve ter no mínimo 1 caracteres',

            'email.email' => 'Formato de email inválido',

            'password.min' => 'A senha deve ter no mínimo 4 caracteres',
            'password.max' => 'A senha deve ter no máximo 8 caracteres',
        ];

        $request->validate($rules, $feedback);

        //create new user in DB
        $user = $request->all();
        $user['password'] = bcrypt($request->password);

        //checking if a user exists in the database
        $userEmail = User::where('email', $request->email)->first();

        if ($userEmail)
            return redirect()->back()->with('erro', 'O email digitado já está cadastrado!');
        $user = User::create($user);

        Auth::login($user);

        return redirect()->route('site.home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
