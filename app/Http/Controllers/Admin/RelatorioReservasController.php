<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RelatorioReservasController extends Controller
{
    public function getTodayReservations(Request $request): View
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get(env('API_URL') . 'relatorios/reservas/dia', [
            'page' => $request->get('page'),
            'search' => $request->get('search'),
            'filter' => $request->get('filter'),
        ]);

        if ($response->failed()) {
            return view('errors.page404');
        }

        $reservas = $response->json();

        if ($request->get('page') > $reservas['reservas']['last_page']) {
            return view('errors.page404');
        }

        return view('pages.admin.reservas.index', [
            'reservas' => $reservas['reservas'],
            'titulo' => 'Reservas do Dia'
        ]);
    }

    public function getWeekReservations(Request $request): View
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get(env('API_URL') . 'relatorios/reservas/semana', [
            'page' => $request->get('page'),
            'search' => $request->get('search'),
            'filter' => $request->get('filter'),
        ]);

        if ($response->failed()) {
            return view('errors.page404');
        }

        $reservas = $response->json();

        if ($request->get('page') > $reservas['reservas']['last_page']) {
            return view('errors.page404');
        }

        return view('pages.admin.reservas.index', [
            'reservas' => $reservas['reservas'],
            'titulo' => 'Reservas da Semana'
        ]);
    }

    public function getMonthReservations(Request $request): View
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get(env('API_URL') . 'relatorios/reservas/mes', [
            'page' => $request->get('page'),
            'search' => $request->get('search'),
            'filter' => $request->get('filter'),
        ]);

        if ($response->failed()) {
            return view('errors.page404');
        }

        $reservas = $response->json();

        if ($request->get('page') > $reservas['reservas']['last_page']) {
            return view('errors.page404');
        }

        return view('pages.admin.reservas.index', [
            'reservas' => $reservas['reservas'],
            'titulo' => 'Reservas do Mês'
        ]);
    }
}
