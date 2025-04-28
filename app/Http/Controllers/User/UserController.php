<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create(): View
    // {
    //     return view('pages.users.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request): RedirectResponse
    // {
    //     $response = Http::post('http://localhost:3030/api/users/', [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => $request->password
    //        ]);

    //     if ($response->successful()) {
    //         return redirect()->route('login')->with('success', $response['message']);
    //     }

    //     return redirect()->back()->withInput()->withErrors(['error' => $response['errors']]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("http://localhost:3030/api/users/{$id}");

        if ($response->successful()) {
            $user = $response->json();

            if ($user['role'] == 'admin') {
                return view('errors.page404');
            }

            $reservas = Http::withToken($token)->get("http://localhost:3030/api/reservas?user_id={$id}")->json();

            return view('pages.users.dashboard', ['user' => $user, 'reservas' => $reservas['data']]);
        }
        return redirect()->back()->with('error', 'Erro');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("http://localhost:3030/api/users/{$id}");

        if ($response->successful()) {
            $user = $response->json();

            if ($user['role'] == 'admin') {
                return view('errors.page404');
            }

            return view('pages.users.edit', ['user' => $user]);
        }

        return view('errors.page404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id): RedirectResponse
    {
        $token = session('api_token');

        $phone = preg_replace('/\D/', '', $request->phone);

        $response = Http::withToken($token)->put("http://localhost:3030/api/users/{$id}", [
            'name' => $request->name,
            'phone' => $phone
        ]);

        if($response->successful()) {
            return redirect()->route('users.show', ['user' => $id])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $token = session('api_token');

        $response = Http::withToken($token)->delete("http://localhost:3030/api/users/{$id}");

        if($response->successful()) {
            session()->forget('api_token', 'user_id', 'user_role', 'user_name');
            return redirect()->route('login')->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
