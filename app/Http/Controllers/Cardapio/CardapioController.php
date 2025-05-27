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
    public function index()
    {
        $token = session('api_token');
        $response =  Http::withToken($token)->get(env('API_URL') . 'cardapio');

        if ($response->successful()) {
            $prato = $response->json();
            $pratos = collect($prato['pratos']);

            return view('pages.cardapio.index', ['pratos' => $pratos]);
        }

        return view('errors.page404');
    }
}
