<?php

namespace Tests\Feature;

use App\Models\Motorista;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MotoristaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_motorista()
    {
        // Dados de teste
        $data = [
            'nome' => 'João Silva',
            'data_nascimento' => '1990-05-15',
            'cnh' => '1234567890',
        ];

        // Enviar a requisição para criar um motorista
        $response = $this->post(route('motoristas.store'), $data);

        // Verificar se a resposta foi de sucesso
        $response->assertStatus(302); // Status 302 é de redirecionamento após criar

        // Verificar se o motorista foi realmente criado
        $this->assertDatabaseHas('motoristas', [
            'nome' => 'João Silva',
            'data_nascimento' => '1990-05-15',
            'cnh' => '1234567890',
        ]);
    }

   /** @test */
public function it_can_list_motoristas()
{
    // Criar um motorista
    Motorista::create([
        'nome' => 'João Silva',
        'data_nascimento' => '1990-05-15',
        'cnh' => '1234567890',
    ]);

    // Verificar se a página de listagem está retornando os dados corretamente
    $response = $this->get(route('motoristas.index'));

    $response->assertStatus(200); // Verificar se a resposta foi bem-sucedida
    $response->assertSee('João Silva'); // Verificar se o nome aparece na página
}
}
