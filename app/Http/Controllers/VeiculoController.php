<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Exception;

class VeiculoController extends Controller
{
    public function index()
    {
        $veiculos = Veiculo::all(); // Recupera todos os veículos
        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        return view('veiculos.create'); // Exibe o formulário para cadastrar veículo
    }

    public function store(Request $request)
    {
        // {
        //     dd($request->all()); // Isso irá mostrar os dados que estão chegando na requisição
        // }
        
        $request->validate([
            'modelo' => 'required|string',
            'ano' => 'required|integer',
            'data_aquisicao' => 'required|date',
            'km_aquisicao' => 'required|integer',
            'renavam' => 'required|string|unique:veiculos',
            'placa' => 'required|string|unique:veiculos'
        ]);

        // Dados validados, agora vamos continuar com a criação
        $data = $request->all();
        $data['data_aquisicao'] = Carbon::createFromFormat('Y-m-d', $request->data_aquisicao)->format('Y-m-d');

        try {
            Veiculo::create($data);
            return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
        } catch (\Exception $e) {
            dd($e->getMessage()); // Exibe o erro caso ocorra
        }
    }


    public function show($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        return view('veiculos.show', compact('veiculo'));
    }

    public function edit($id)
    {
        $veiculo = Veiculo::findOrFail($id);
    
        // Certifique-se de que a data_aquisicao seja um objeto Carbon
        $veiculo->data_aquisicao = Carbon::parse($veiculo->data_aquisicao);
    
        return view('veiculos.edit', compact('veiculo'));
    }
    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer',
            'data_aquisicao' => 'required|date',
            'km_aquisicao' => 'required|integer',
            'renavam' => [
                'required',
                'string',
                'max:255',
                Rule::unique('veiculos')->ignore($id) // Ignora o próprio ID
            ],
            'placa' => [
                'required',
                'string',
                'max:255',
                Rule::unique('veiculos')->ignore($id) // Ignora o próprio ID
            ],
        ]);
    
        // Encontrar o veículo
        $veiculo = Veiculo::findOrFail($id);
    
        // Atualizar os dados do veículo
        $data_aquisicao = Carbon::parse($request->data_aquisicao);
    
        $veiculo->update([
            'modelo' => $request->modelo,
            'ano' => $request->ano,
            'data_aquisicao' => $data_aquisicao,
            'km_aquisicao' => $request->km_aquisicao,
            'renavam' => $request->renavam,
            'placa' => $request->placa,
        ]);
    
        // Redirecionar com sucesso
        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }
    
    

    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        if (method_exists($veiculo, 'viagens') && $veiculo->viagens()->exists()) {
            return redirect()->route('veiculos.index')->with('error', 'Não é possível excluir, veículo possui viagens vinculadas.');
        }

        $veiculo->delete();
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }
}