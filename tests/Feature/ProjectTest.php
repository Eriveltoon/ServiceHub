<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_criar_project(): void
    {
        $user = User::factory()->create();
        $company = Company::create([
            'name' => 'Empresa Teste'
        ]);

        $this->actingAs($user)
            ->post(route('projects.store'), [
                'name' => 'Project Teste',
                'company_id' => $company->id,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('projects', [
            'name' => 'Project Teste',
            'company_id' => $company->id,
        ]);
    }
}
