<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
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
    public function store(Request $request): RedirectResponse
    {
        $response = Http::post('http://localhost:3030/api/login/', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if($response->successful()) {
            $data = $response->json();
            $user = $data['user'];

            session(['api_token' => $data['token']]);

            Auth::loginUsingId($user['id']);

            if ($user['role'] == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('users.show', ['user' => $user['id']]);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): RedirectResponse
    {
        $token = session('api_token');

        if ($token) {
            $response = Http::withToken($token)->delete('http://localhost:3030/api/logout');

            if ($response->successful()) {
                session()->forget('api_token');
                Auth::logout();

                return redirect()->route('login')->with('success', $response['message']);
            }

            return redirect()->back()->with('error', 'Erro ao tentar realizar logout na API');
        }

        Auth::logout();

        return redirect()->back()->with('error', 'Não há token');
    }
}
