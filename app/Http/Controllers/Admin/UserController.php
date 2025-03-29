<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(String $id) : View
    {
        $user = User::findOrFail($id);
        $reservas = $user->reservas;

        return view('pages.admin.users.show', ['user' => $user, 'reservas' => $reservas]);
    }
}
