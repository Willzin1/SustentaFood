<?php

namespace App\Http\Controllers\Cardapio;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $token = session('api_token');
        $response =  Http::withToken($token)->get('http://localhost:3030/api/cardapio');

        if ($response->successful()) {
            $prato = $response->json();
            $pratos = collect($prato['data']);

            return view('pages.cardapio.index', compact('pratos'));
        }

        return view('errors.page404');
    }
}
