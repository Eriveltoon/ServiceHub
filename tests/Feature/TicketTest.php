<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_pode_criar_ticket(): void
    {
        $user = User::factory()->create();

        $company = Company::create([
            'name' => 'Empresa Teste'
        ]);

        $project = Project::create([
            'name' => 'Project Teste',
            'company_id' => $company->id,
        ]);

        $this->actingAs($user)
            ->post(route('tickets.store'), [
                'title' => 'Ticket Teste',
                'description' => 'Descrição do ticket',
                'status' => 'open',
                'project_id' => $project->id,
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('tickets', [
            'title' => 'Ticket Teste',
            'project_id' => $project->id,
            'status' => 'open',
        ]);
    }
}
