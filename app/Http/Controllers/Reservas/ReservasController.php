<?php

namespace App\Http\Controllers\Reservas;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReservasController extends Controller
{
    public readonly Reserva $reserva;
    public function __construct()
    {
        $this->reserva = new Reserva;
    }

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
        $user = Auth::user();
        $reservasAtual = $this->reserva->where('user_id', $user->id)->count();
        $token = session('api_token');

        if ($reservasAtual >= 4) {
            return redirect()->back()->with('error', 'Você já atingiu o limite de 4 reservas.');
        }

        $response = Http::withToken($token)->post('http://localhost:3030/api/reservas', [
            'data' => $request->data,
            'hora' => $request->hora,
            'quantidade_cadeiras' => $request->quantidade_cadeiras === 'mais' ? $request->quantidade_custom : $request->quantidade_cadeiras,
        ]);

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user->id])->with('success', $response['message']);
        }

        return redirect()->route('users.show', ['user' => $user->id])->with('error', $response['message']);
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
    public function edit(string $id): View
    {
        $reserva = $this->reserva->find($id);
        return view('pages.reservas.edit', ['reserva' => $reserva]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = Auth::user();
        $reserva = $this->reserva->find($id);
        $token = session('api_token');
        $dados = $request->except(['_method', '_token', 'quantidade_custom']);

        $response = Http::withToken($token)->put('http://localhost:3030/api/reservas/' . $reserva->id, $dados);

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user->id])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = Auth::user();
        $reserva = $this->reserva->find($id);
        $token = session('api_token');
        $response = Http::withToken($token)->delete('http://localhost:3030/api/reservas/' . $reserva->id);

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user->id])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
