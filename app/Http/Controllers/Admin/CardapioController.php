<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prato;
use Illuminate\Http\Request;

class CardapioController extends Controller
{
    public readonly Prato $prato;
    public function __construct()
    {
        $this->prato = new Prato;
    }


    public function index()
    {
        $pratos = Prato::all();
        return view('pages.admin.cardapio.index', compact('pratos'));
    }

    public function create()
    {
        return view('pages.admin.cardapio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|in:Entradas,Prato principal,Sobremesas,Cardapio infantil,Bebidas',
        ]);

        $created = $this->prato->create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'categoria' => $request->categoria
        ]);

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('pratos', 'public');
            $created->imagem = $path;
            $created->save();
        }

        return redirect()->route('admin.cardapio.index')->with('success', 'Prato adicionado!');
    }

    public function edit(Prato $prato)
    {
        return view('pages.admin.cardapio.edit', compact('prato'));
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'imagem' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|in:Entradas,Prato principal,Sobremesas,Cardapio infantil,Bebidas',
        ]);

        $updated = $this->prato->where('id', $id)->update($request->except('_token', '_method', 'imagem'));

        if ($request->hasFile('imagem')) {
            $path = $request->file('imagem')->store('pratos', 'public');
            $updated->imagem = $path;
            $updated->save();
        }

        if(!$updated) {
            return redirect()->back()->with('error', 'Não foi possivel alterar');
        }

        return redirect()->route('admin.cardapio.index')->with('success', 'Prato atualizado!');
    }

    public function destroy(Prato $prato)
    {
        $prato->delete();
        return redirect()->route('admin.cardapio.index')->with('success', 'Prato removido!');
    }

}
