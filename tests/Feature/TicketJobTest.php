<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class TicketJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_processa_ticket_e_cria_ticket_detail(): void
    {
        Storage::fake('local');

        $user = User::factory()->create();

        $company = Company::create([
            'name' => 'Empresa Teste'
        ]);

        $project = Project::create([
            'name' => 'Project Teste',
            'company_id' => $company->id,
        ]);

        $fileContent = json_encode([
            'os' => '123',
            'priority' => 'high',
            'description' => 'Ticket processado via job'
        ]);

        $path = 'tickets/test.json';

        Storage::put($path, $fileContent);

        $ticket = Ticket::create([
            'title' => 'Ticket Job Teste',
            'description' => 'Teste job',
            'status' => 'open',
            'project_id' => $project->id,
            'user_id' => $user->id ?? null,
            'attachment_path' => $path,
        ]);

        // executa o job diretamente
        (new \App\Jobs\ProcessTicketJob($ticket))->handle();

        $this->assertDatabaseHas('ticket_details', [
            'ticket_id' => $ticket->id,
        ]);

        $this->assertDatabaseHas('ticket_details', [
            'ticket_id' => $ticket->id,
        ]);

        $this->assertNotNull($ticket->fresh()->detail);
    }
}
