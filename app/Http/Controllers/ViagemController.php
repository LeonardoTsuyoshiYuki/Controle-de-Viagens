<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viagem;
use App\Models\Veiculo;
use App\Models\Motorista;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ViagemController extends Controller
{
    // Listar todas as viagens
    public function index()
    {
        $viagens = Viagem::with(['motorista', 'veiculo'])->orderBy('data_hora_saida', 'desc')->get();
        return view('viagens.index', compact('viagens'));
    }

    // Exibir uma viagem específica
    public function show($id)
    {
        $viagem = Viagem::findOrFail($id);
    
        // Forçar a conversão das datas para instâncias do Carbon
        $viagem->data_hora_saida = Carbon::parse($viagem->data_hora_saida);
        $viagem->data_hora_chegada = $viagem->data_hora_chegada 
            ? Carbon::parse($viagem->data_hora_chegada) 
            :null;

    
        return view('viagens.show', compact('viagem'));
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('viagens.create', [
            'motoristas' => Motorista::orderBy('nome')->get(),
            'veiculos' => Veiculo::orderBy('modelo')->get()
        ]);
    }

    // Armazenar uma nova viagem
    public function store(Request $request)
    {
        try {
            Log::info('Dados recebidos no store:', $request->all());

            // Validação dos dados
            $validated = $request->validate([
                'motorista_id' => 'required|exists:motoristas,id',
                'veiculo_id' => 'required|exists:veiculos,id',
                'km_inicial' => 'required|integer|min:0',
                'km_final' => 'nullable|integer|min:0',
                'data_hora_saida' => 'required|date',
                'data_hora_chegada' => 'nullable|date|after_or_equal:data_hora_saida',
            ]);

            // Ajustar valores das datas
            $validated['data_hora_saida'] = Carbon::parse($validated['data_hora_saida']);

            // **Se data_hora_chegada vier vazia, garantir que será null**
            $validated['data_hora_chegada'] = $request->filled('data_hora_chegada') 
                ? Carbon::parse($validated['data_hora_chegada']) 
                : null;

            Log::info('Dados prontos para inserção:', $validated);

            // Salvar no banco
            $viagem = Viagem::create($validated);

            Log::info('Viagem salva com sucesso:', $viagem->toArray());

            return redirect()->route('viagens.index')->with('success', 'Viagem cadastrada com sucesso!');

        } catch (\Exception $e) {
            Log::error('Erro ao salvar viagem: ' . $e->getMessage());
            return back()->withErrors('Erro ao salvar viagem: ' . $e->getMessage())->withInput();
        }
    }


    // Editar uma viagem
    public function edit($id)
    {
        $viagem = Viagem::findOrFail($id);

        return view('viagens.edit', [
            'viagem' => $viagem,
            'motoristas' => Motorista::orderBy('nome')->get(),
            'veiculos' => Veiculo::orderBy('modelo')->get()
        ]);
    }

    // Atualizar uma viagem
    public function update(Request $request, $id)
    {
        try {
            Log::info('Dados recebidos no update:', $request->all());

            $viagem = Viagem::findOrFail($id);

            // Validação dos dados
            $validated = $request->validate([
                'motorista_id' => 'required|exists:motoristas,id',
                'veiculo_id' => 'required|exists:veiculos,id',
                'km_inicial' => 'required|integer|min:0',
                'km_final' => 'nullable|integer|min:0',
                'data_hora_saida' => 'required|date',
                'data_hora_chegada' => 'nullable|date|after_or_equal:data_hora_saida',
            ]);

            // Ajustar valores das datas
            $validated['data_hora_saida'] = Carbon::parse($validated['data_hora_saida']);

            // **Se data_hora_chegada vier vazia, garantir que será null**
            $validated['data_hora_chegada'] = $request->filled('data_hora_chegada') 
                ? Carbon::parse($validated['data_hora_chegada']) 
                : null;

            Log::info('Dados prontos para atualização:', $validated);

            // **Atualizar a viagem existente**
            $viagem->update($validated);

            Log::info('Viagem atualizada com sucesso:', $viagem->toArray());

            return redirect()->route('viagens.index')->with('success', 'Viagem atualizada com sucesso!');
            
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar viagem: ' . $e->getMessage());
            return back()->withErrors('Erro ao atualizar viagem: ' . $e->getMessage())->withInput();
        }
    }

    

    // Excluir uma viagem
    public function destroy($id)
    {
        try {
            $viagem = Viagem::findOrFail($id);
            $viagem->delete();

            return redirect()->route('viagens.index')->with('success', 'Viagem excluída com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao excluir viagem: ' . $e->getMessage());
            return back()->withErrors('Erro ao excluir viagem: ' . $e->getMessage());
        }
    }
}