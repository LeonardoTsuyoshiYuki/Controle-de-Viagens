<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = Motorista::all();
        return view('motoristas.index', compact('motoristas'));
    }

    public function create()
    {
        return view('motoristas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $idade = \Carbon\Carbon::parse($value)->age;
                    if ($idade < 18) {
                        $fail('O motorista deve ter pelo menos 18 anos.');
                    }
                }
            ],
            'cnh' => 'required|string|unique:motoristas,cnh',
        ]);
    
        $motorista = new Motorista();
        $motorista->nome = $request->nome;
        $motorista->data_nascimento = $request->data_nascimento;
        $motorista->cnh = $request->cnh;
        $motorista->save();
    
        return redirect()->route('motoristas.index')->with('success', 'Motorista criado com sucesso!');
    }


    public function show(Motorista $motorista)
    {
        return view('motoristas.show', compact('motorista'));
    }

    public function edit(Motorista $motorista)
    {
        return view('motoristas.edit', compact('motorista'));
    }

    public function update(Request $request, $id)
    {
        // Busca o motorista pelo ID
        $motorista = Motorista::find($id);
        if (!$motorista) {
            return redirect()->route('motoristas.index')->with('error', 'Motorista não encontrado.');
        }

        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (\Carbon\Carbon::parse($value)->age < 18) {
                        $fail('O motorista deve ter pelo menos 18 anos.');
                    }
                }
            ],
            'cnh' => 'required|string|unique:motoristas,cnh,' . $motorista->id,
        ]);

        // Atualiza os dados do motorista
        $motorista->update([
            'nome' => $request->nome,
            'data_nascimento' => $request->data_nascimento,
            'cnh' => $request->cnh,
        ]);

        return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso!');
    }


    public function destroy(Motorista $motorista)
    {
        $motorista->delete();
        return redirect()->route('motoristas.index');
    }
}
