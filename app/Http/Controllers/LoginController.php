<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function auth(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'], 
            'password' => ['required'],  
        ], [
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email inválido',
            'password.required' => 'Senha é obrigatório',
        ],);
    
        if(Auth::attempt($credentials, $request->remember)){
            $request->session()->regenerate();
            return redirect()->intended(route('site.home'));
        } else {
            return redirect()->back()->with('erro', 'Email ou senha inválida.');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('site.home'));
    }
} 
