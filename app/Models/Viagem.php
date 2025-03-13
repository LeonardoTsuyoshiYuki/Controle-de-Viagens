<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class Viagem extends Model
{
//     protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($viagem) {
//         dd($viagem->toArray()); // Exibe os dados antes de serem inseridos no banco
//     });
// }

    use HasFactory;

    protected $table = 'viagens'; // Defina explicitamente o nome da tabela

    protected $fillable = [
        'motorista_id',
        'veiculo_id',
        'km_inicial',
        'km_final',
        'data_hora_saida',
        'data_hora_chegada',
    ];

    protected $dates = [
        'data_hora_saida',
        'data_hora_chegada',
    ];
    // Relacionamento com Motorista
    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

    // Relacionamento com Veículo
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    // Regras de validação para criação e edição
    public static function rules()
    {
        return [
            'motorista_id' => 'required|exists:motoristas,id',
            'veiculo_id' => 'required|exists:veiculos,id',
            'km_inicial' => 'required|integer|min:0',
            'km_final' => 'nullable|integer|min:0',
            'data_hora_saida' => 'required|date',
            'data_hora_chegada' => 'nullable|date|after_or_equal:data_hora_saida',
        ];
    }

    // Função para validar uma viagem
    public static function validateViagem($data)
    {
        // Validar regras básicas
        $validator = Validator::make($data, self::rules());

        // Verificar se a validação falhou
        if ($validator->fails()) {
            return $validator->errors();
        }

        // Se km_final foi informado, garantir que seja maior que km_inicial
        if (!empty($data['km_final']) && $data['km_final'] <= $data['km_inicial']) {
            $validator->errors()->add('km_final', 'O KM final deve ser maior que o KM inicial.');
        }

        return $validator->fails() ? $validator->errors() : true;
    }

    // Mutators para formatar as datas corretamente ao acessar
    public function getDataHoraSaidaAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getDataHoraChegadaAttribute($value)
    {
        return $value ? Carbon::parse($value) : null;
    }
}
