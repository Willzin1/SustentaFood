<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public readonly User $user;
    public function __construct()
    {
        $this->user = new User;
    }

    public function create() {
        return view('users.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'Senha deve conter pelo menos :min caracteres',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if(!$user) {
            return redirect()->back()->with('error', 'E-mail não encontrado.');
        }

        if(!password_verify($request->input('password'), $user->password)) {
            return redirect()->back()->with('error', 'Senha inválida.');
        }

        Auth::loginUsingId($user->id);

        return redirect()->route('users.show', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Deslogado');
    }
}
