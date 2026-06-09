<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Projects/Index', [
            'projects' => Project::with('company')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->select('id', 'name')->get();

        return Inertia::render('Projects/Create', [
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'company_id' => ['required', 'exists:companies,id'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'O nome do projeto é obrigatório.',
            'name.string' => 'O nome do projeto deve ser um texto válido.',
            'name.max' => 'O nome do projeto não pode ultrapassar 50 caracteres.',
            'company_id.required' => 'A empresa é obrigatória.',
            'company_id.exists' => 'A empresa selecionada é inválida.',
            'description.string' => 'A descrição do projeto deve ser um texto válido.',
        ]);

        Project::create([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.index')->with('success', 'Projeto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia('Projects/Show', [
            'project' => Project::with('company')->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return inertia('Projects/Edit', [
            'project' => $project->load('company'),
            'companies' => Company::orderBy('name')->select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'company_id' => ['required', 'exists:companies,id'],
            'description' => ['nullable', 'string'],
        ], [
            'name.required' => 'O nome do projeto é obrigatório.',
            'name.string' => 'O nome do projeto deve ser um texto válido.',
            'name.max' => 'O nome do projeto não pode ultrapassar 50 caracteres.',
            'company_id.required' => 'A empresa é obrigatória.',
            'company_id.exists' => 'A empresa selecionada é inválida.',
            'description.string' => 'A descrição do projeto deve ser um texto válido.',
        ]);

        $project->update([
            'name' => $request->name,
            'company_id' => $request->company_id,
            'description' => $request->description,
        ]);

        return redirect()->route('projects.index')->with('success', 'Projeto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index');
    }
}
