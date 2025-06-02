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
        $date = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/', '$3-$2-$1', $request->data);
        $phone = preg_replace('/\D/', '', $request->phone);

         if (! $token) {
            $response = Http::post(env('API_URL') . 'reservas/notLoggedUser', [
                'data' => $date,
                'hora' => $request->hora,
                'quantidade_cadeiras' => $request->quantidade_cadeiras === 'mais' ? $request->quantidade_custom : $request->quantidade_cadeiras,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $phone
            ]);

            if ($response->successful()) {
                return redirect()->back()->with(['success' => $response['message'], 'info' => 'Por favor, confirme a reserva no e-mail.']);
            }

            return redirect()->back()->with('error', $response['message']);
         }

        $response = Http::withToken($token)->post(env('API_URL') . 'reservas', [
            'data' => $date,
            'hora' => $request->hora,
            'quantidade_cadeiras' => $request->quantidade_cadeiras === 'mais' ? $request->quantidade_custom : $request->quantidade_cadeiras,
        ]);

        $user = $response->json();

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user['reserva']['user_id']])->with(['success' => $response['message'], 'info' => 'Por favor, confirme a reserva no e-mail.']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get(env('API_URL') . "reservas/{$id}");

        if ($response->successful()) {
            $reserva = $response->json();

            return view('pages.reservas.edit', compact('reserva'));
        }

        return redirect()->back()->with('error', 'Não foi possível carregar a reserva.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $token = session('api_token');

        $date = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/', '$3-$2-$1', $request->data);
        $time = preg_replace('/^.*T(\d{2}:\d{2}):.*$/', '$1', $request->hora);

        $response = Http::withToken($token)->put(env('API_URL') . "reservas/{$id}", [
            'data' => $date,
            'hora' => $time,
            'quantidade_cadeiras' => $request->quantidade_cadeiras === 'mais' ? $request->quantidade_custom : $request->quantidade_cadeiras,
        ]);

        $user = $response->json();

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user['reserva']['user_id']])->with(['success' => $response['message'], 'info' => 'Por favor, confirme a reserva no e-mail.']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $token = session('api_token');
        $response = Http::withToken($token)->delete(env('API_URL') . "reservas/{$id}");

        $user = $response->json();

        if ($response->successful()) {
            return redirect()->route('users.show', ['user' => $user['user']['user_id']])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function cancel(string $id): RedirectResponse
    {
        $token = session('api_token');
        $response = Http::withToken($token)->post(env('API_URL') . "reservas/{$id}/cancelar");

        if ($response->successful()) {
            return redirect()->back()->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
