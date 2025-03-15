<?php

namespace App\Http\Controllers\Reservas;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasController extends Controller
{
    public readonly Reserva $reserva;
    public function __construct()
    {
        $this->reserva = new Reserva;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reservas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $reservasAtual = $this->reserva->where('user_id', $user->id)->count();

        if ($reservasAtual >= 4) {
            return redirect()->back()->with('error', 'Você já atingiu o limite de 4 reservas.');
        }

        $request->validate([
            'data' => 'required',
            'hora' => 'required',
            'quantidade_cadeiras' => 'required',
            'quantidade_custom' => 'required_if:quantidade_cadeiras,mais'
        ], [
            'data.required' => 'Informe uma data',
            'hora.required' => 'Informe o horário da reserva',
            'quantidade_cadeiras.required' => 'Informe a quantidade de cadeiras',
            'quantidade_custom.required_if' => 'Informe uma quantidade personalizada'
        ]);

        $created = $this->reserva->create([
            'user_id' => $user->id,
            'data' => $request->input('data'),
            'hora' => $request->input('hora'),
            'quantidade_cadeiras' => $request->input('quantidade_cadeiras') === 'mais' ? $request->input('quantidade_custom') : $request->input('quantidade_cadeiras'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if (!$created) {
            return redirect()->route('users.show', ['user' => $user->id])->with('error', 'Erro ao fazer reserva.');
        }

        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Reserva efetuada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reserva = $this->reserva->find($id);
        return view('reservas.edit', ['reserva' => $reserva]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $quantidade = $request->input('quantidade_cadeiras') === 'mais' ? $request->input('quantidade_custom') : $request->input('quantidade_cadeiras');

        $dados = $request->except('_token', '_method', 'quantidade_custom');
        $dados['quantidade_cadeiras'] = $quantidade;

        $request->validate([
            'data' => 'required',
            'hora' => 'required',
            'quantidade_cadeiras' => 'required',
            'quantidade_custom' => 'required_if:quantidade_cadeiras,mais'
        ], [
            'data.required' => 'Informe uma data',
            'hora.required' => 'Informe o horário da reserva',
            'quantidade_cadeiras.required' => 'Informe a quantidade de cadeiras',
            'quantidade_custom.required_if' => 'Informe uma quantidade personalizada'
        ]);

        $updated = $this->reserva->where('id', $id)->update($dados);

        if (!$updated) {
            redirect()->back()->with('error', 'Erro ao alterar reserva');
        }

        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Reserva alterada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $deleted = $this->reserva->where('id', $id)->delete();

        if (!$deleted) {
            return redirect()->back()->with('error', 'Erro ao deletar reserva');
        }

        return redirect()->route('users.show', ['user' => $user->id])->with('success', 'Reserva apagada com sucesso.');
    }
}
