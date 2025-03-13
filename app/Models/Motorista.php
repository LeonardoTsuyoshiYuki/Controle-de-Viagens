<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'data_nascimento', 
        'cnh',
    ];

    // Desabilita timestamps se a tabela não tiver campos de data
    public $timestamps = true; // Se você estiver utilizando timestamps (created_at e updated_at)

    // Regras de validação
    public static function rules()
    {
        return [
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'cnh' => 'required|string|unique:motoristas,cnh',  // Verifique a regra de unicidade para a CNH
        ];
    }
}

