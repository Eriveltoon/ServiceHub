<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_criar_empresa(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('companies.store'), [
                'name' => 'Empresa Teste',
            ])
            ->assertRedirect(route('companies.index'));

        $this->assertDatabaseHas('companies', [
            'name' => 'Empresa Teste',
        ]);
    }
}
