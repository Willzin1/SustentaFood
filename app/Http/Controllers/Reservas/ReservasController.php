<?php

namespace App\Http\Controllers\Reservas;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReservasController extends Controller
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
    public function create(): View
    {
        return view('pages.reservas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $token = session('api_token');

        $response = Http::withToken($token)->post('http://localhost:3030/api/reservas', [
            'data' => $request->data,
            'hora' => $request->hora,
            'quantidade_cadeiras' => $request->quantidade_cadeiras === 'mais' ? $request->quantidade_custom : $request->quantidade_cadeiras,
        ]);

        $user = $response->json();

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user['reserva']['user_id']])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
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
        $token = session('api_token');
        $response = Http::withToken($token)->get("http://localhost:3030/api/reservas/{$id}");

        if ($response->successful()) {
            $reserva = $response->json();
            return view('pages.reservas.edit', compact('reserva'));
        }

        return back()->with('error', 'Não foi possível carregar a reserva.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $token = session('api_token');
        $dados = $request->except(['_method', '_token', 'quantidade_custom']);

        $response = Http::withToken($token)->put("http://localhost:3030/api/reservas/{$id}", $dados);

        $user = $response->json();

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user['reserva']['user_id']])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $token = session('api_token');
        $response = Http::withToken($token)->delete("http://localhost:3030/api/reservas/{$id}");

        $user = $response->json();

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user['user']['user_id']])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
