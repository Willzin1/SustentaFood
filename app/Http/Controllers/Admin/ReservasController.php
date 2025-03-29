<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    public function index() {
        $reservas = Reserva::with('user')->paginate(4);
        return view('pages.admin.reservas.index', ['reservas' => $reservas]);
    }

    public function show(String $id) {
        $reserva = Reserva::with('user')->findOrFail($id);

        return view('pages.admin.reservas.show', ['reserva' => $reserva]);
    }

}
