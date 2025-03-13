<?php

// app/Models/Veiculo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;


class Veiculo extends Model
{
    use HasFactory;

    // Definir quais campos podem ser preenchidos
    protected $fillable = [
        'modelo',
        'ano',
        'data_aquisicao',
        'km_aquisicao',
        'renavam',
        'placa'
    ];

    // Configuração de formato de data
    protected $dates = ['data_aquisicao'];

    // Validar se a data de aquisição está no formato correto (caso não tenha sido feito antes)
    public static function rules($id = null)
    {
        return [
            'modelo' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'data_aquisicao' => 'required|date',
            'km_aquisicao' => 'required|integer',
            'renavam' => [
                'required',
                'string',
                'size:11',
                Rule::unique('veiculos')->ignore($id),
            ],
            'placa' => [
                'required',
                'string',
                'size:7',
                Rule::unique('veiculos')->ignore($id),
            ],
        ];
    }
    
}
