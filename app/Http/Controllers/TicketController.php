<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\Company;
use App\Jobs\ProcessTicketJob;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Tickets/Index', [
            'tickets' => Ticket::with(['project.company'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::orderBy('name')->select('id', 'name')->get();

        return Inertia::render('Tickets/Create', [
            'projects' => $projects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:open,in_progress,closed'],
            'project_id' => ['required', 'exists:projects,id'],
            'attachment_path' => ['nullable', 'file', 'max:2048'],
        ], [
            'title.required' => 'O título do ticket é obrigatório.',
            'title.string' => 'O título do ticket deve ser um texto válido.',
            'title.max' => 'O título do ticket não pode ultrapassar 100 caracteres.',
            'status.required' => 'O status do ticket é obrigatório.',
            'status.in' => 'O status deve ser open, in_progress',
            'project_id.required' => 'O projeto é obrigatório.',
            'project_id.exists' => 'O projeto selecionado é inválido.',
            'attachment_path.file' => 'O arquivo deve ser válido.',
            'attachment_path.max' => 'O arquivo não pode ultrapassar 2MB.',
        ]);

        $ticketData = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'project_id' => $request->project_id,
            'user_id' => Auth::id(),
        ];

        if ($request->hasFile('attachment_path')) {
            $ticketData['attachment_path'] = $request->file('attachment_path')
                ->store('tickets/attachments');
        }

        $ticket = Ticket::create($ticketData);

        // ProcessTicketJob::dispatch($ticket->id);
        ProcessTicketJob::dispatch($ticket);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Tickets/Show', [
            'ticket' => Ticket::with([
                'project.company',
                'detail',
                'user',
            ])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return inertia('Tickets/Edit', [
            'ticket' => $ticket->load('project'),
            'projects' => Project::orderBy('name')->select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:open,in_progress,closed'],
            'project_id' => ['required', 'exists:projects,id'],
            'attachment_path' => ['nullable', 'file', 'max:2048'],
            ], [
                'title.required' => 'O título do ticket é obrigatório.',
                'title.string' => 'O título do ticket deve ser um texto válido.',
                'title.max' => 'O título do ticket não pode ultrapassar 100 caracteres.',
                'status.required' => 'O status do ticket é obrigatório.',
                'status.in' => 'O status deve ser open, in_progress ou closed.',
                'project_id.required' => 'O projeto é obrigatório.',
                'project_id.exists' => 'O projeto selecionado é inválido.',
                'attachment_path.file' => 'O arquivo deve ser válido.',
                'attachment_path.max' => 'O arquivo não pode ultrapassar 2MB.',
                ]);

        $ticket = Ticket::findOrFail($id);



        $ticketData = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'project_id' => $request->project_id,
            ];

        // se tiver novo arquivo, substitui o anterior
        if ($request->hasFile('attachment_path')) {


            // opcional: apagar antigo
            if ($ticket->attachment_path) {
                Storage::delete($ticket->attachment_path);
            }

            $ticketData['attachment_path'] = $request->file('attachment_path')
                ->store('tickets/attachments');

        }

        $ticket->update($ticketData);

        // recarrega do banco (estado atualizado)
        $ticket->refresh();


        ProcessTicketJob::dispatch($ticket);
        // ProcessTicketJob::dispatch($ticket->id);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
