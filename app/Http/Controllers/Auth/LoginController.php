<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public readonly User $user;
    public function __construct()
    {
        $this->user = new User;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('pages.users.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
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
            return redirect()->back()->with('error', 'E-mail ou senha inválidos.');
        }

        if(!password_verify($request->input('password'), $user->password)) {
            return redirect()->back()->with('error', 'E-mail ou senha inválidos.');
        }

        Auth::loginUsingId($user->id);

        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('users.show', ['user' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy() : RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
