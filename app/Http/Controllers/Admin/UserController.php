<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(String $id): View
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get(env('API_URL') . "users/{$id}");

        if ($response->failed()) {
            abort(404, 'Erro inesperado.');
        }

        $user = $response->json();
        $reservas = Http::withToken($token)->get(env('API_URL') . "reservas?user_id={$id}")->json();

        return view('pages.admin.users.show', [
            'user' => $user,
            'reservas' => $reservas
        ]);
    }
}
