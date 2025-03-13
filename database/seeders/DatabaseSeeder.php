<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Motorista;
use App\Models\Veiculo;
use App\Models\Viagem;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed de Motoristas
        Motorista::create([
            'nome' => 'João Silva',
            'data_nascimento' => '1990-05-15',
            'cnh' => '1234567890',
        ]);

        // Seed de Veículos
        Veiculo::create([
            'modelo' => 'Fusca',
            'ano' => 1980,
            'data_aquisicao' => '2020-01-01',
            'km_aquisicao' => 100000,
            'renavam' => '123456789012',
            'placa' => 'ABC-1234',
        ]);

        // Seed de Viagens
        Viagem::create([
            'motorista_id' => 1,
            'veiculo_id' => 1,
            'km_inicial' => 100000,
            'km_final' => 100050,
            'data_hora_saida' => '2025-03-12 08:00:00',
            'data_hora_chegada' => '2025-03-12 10:00:00',
        ]);
    }
}
