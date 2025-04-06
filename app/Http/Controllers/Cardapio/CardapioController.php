<?php

namespace App\Http\Controllers\Cardapio;

use App\Http\Controllers\Controller;
use App\Models\Prato;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $pratos = Prato::all();
        return view('pages.cardapio.index', compact('pratos'));
    }
}
