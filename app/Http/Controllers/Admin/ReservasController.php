<?php

namespace App\Http\Controllers\Admin;

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
    public function index(Request $request): View
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get('http://localhost:3030/api/reservas', [
            'page' => $request->get('page'),
            'search' => $request->get('search'),
            'filter' => $request->get('filter')
        ]);

        if ($response->failed()) {
            return view('errors.page404');
        }

        $reservas = $response->json();

        if ($request->get('page') > $reservas['last_page']) {
            return view('errors.page404');
        }

        return view('pages.admin.reservas.index', [
            'reservas' => $reservas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $token = session('api_token');
        $response = Http::withToken($token)->get("http://localhost:3030/api/reservas/{$id}");

        if ($response->successful()) {
            $reserva = $response->json();
            return view('pages.admin.reservas.show', compact('reserva'));
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $token = session('api_token');

        $date = preg_replace('/^(\d{2})\/(\d{2})\/(\d{4})$/', '$3-$2-$1', $request->data);
        $time = preg_replace('/^.*T(\d{2}:\d{2}):.*$/', '$1', $request->hora);

        $response = Http::withToken($token)->put("http://localhost:3030/api/reservas/{$id}", [
            'data' => $date,
            'hora' => $time,
            'quantidade_cadeiras' => $request->quantidade_cadeiras === 'mais' ? $request->quantidade_custom : $request->quantidade_cadeiras,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.reservas.index')->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['error']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $token = session('api_token');
        $response = Http::withToken($token)->delete("http://localhost:3030/api/reservas/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.reservas.index')->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

}
