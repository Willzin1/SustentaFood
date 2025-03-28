<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $reservas = Reserva::with('user')->paginate(2);
        return view('pages.admin.index', ['reservas' => $reservas]);
    }
}
