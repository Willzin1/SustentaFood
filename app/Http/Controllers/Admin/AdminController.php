<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard() {
        return view('pages.admin.dashboard');
    }

    public function index() {
        $reservas = Reserva::with('user')->paginate(4);
        return view('pages.admin.reservas.index', ['reservas' => $reservas]);
    }

    public function show(String $id) {
        $reserva = Reserva::with('user')->findOrFail($id);

        return view('pages.admin.reservas.show', ['reserva' => $reserva]);
    }

    public function showUser(String $id) {
        $user = User::findOrFail($id);
        $reservas = $user->reservas; // Supondo que o relacionamento entre User e Reserva já esteja definido

        return view('pages.admin.users.show', ['user' => $user, 'reservas' => $reservas]);
    }
}
