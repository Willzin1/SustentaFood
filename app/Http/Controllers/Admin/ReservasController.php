<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
    public function index() : View
    {
        $reservas = Reserva::with('user')->paginate(4);
        return view('pages.admin.reservas.index', ['reservas' => $reservas]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id) : View
    {
        $reserva = Reserva::with('user')->findOrFail($id);
        return view('pages.admin.reservas.show', ['reserva' => $reserva]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {

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

        return redirect()->route('admin.dashboard')->with('success', 'Reserva alterada com sucesso');
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        $deleted = $this->reserva->where('id', $id)->delete();

        if (!$deleted) {
            return redirect()->back()->with('error', 'Erro ao deletar reserva');
        }

        return redirect()->route('admin.dashboard')->with('success', 'Reserva apagada com sucesso.');
    }

}
