<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * Os URIs que devem ser ignorados pela verificação de CSRF.
     *
     * @var array
     */
    protected $except = [
        'motoristas/store', 
        'motoristas',
        'veiculos',
        'viagens',
        'viagens/*',
        'motoristas/*',
        'veiculos/*',
    ];
    
}
