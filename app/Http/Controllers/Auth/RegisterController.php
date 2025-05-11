<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $phone = preg_replace('/\D/', '', $request->phone);

        $response = Http::post(env('API_URL') . 'users', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $phone,
            'password' => $request->password
           ]);

        if ($response->successful()) {
            return redirect()->route('login')->with('success', 'Conta criada com sucesso! Por favor verifique seu e-mail');
        }

        return redirect()->back()->withInput()->withErrors(['error' => $response['errors']]);
    }
}
