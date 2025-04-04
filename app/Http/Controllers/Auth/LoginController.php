<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $response = Http::post('http://localhost:3030/login/', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if($response->successful()) {
            $data = $response->json();
            $userId = $data['user']['id'];

            $user = User::find($userId);
            Auth::loginUsingId($user->id);

            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('users.show', ['user' => $user->id]);
        }

        return redirect()->back()->with('error', 'Erro ao logar');
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
