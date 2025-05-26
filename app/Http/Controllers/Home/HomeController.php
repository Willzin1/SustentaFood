<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(): View
    {
        $response = Http::get(env('API_URL') . 'favoritos/favoritados');
        
        if ($response->successful()) {
            $responseData = $response->json();
            $pratosFavoritos = $responseData['most_favorited'] ?? [];
            $pratosFavoritos = array_slice($pratosFavoritos, 0, 4);
            return view('index', compact('pratosFavoritos'));
        }

        return view('index', ['pratosFavoritos' => []]);
    }
}
