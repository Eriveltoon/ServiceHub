<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Company::class);

        return Inertia::render('Companies/Index', [
            'companies' => Company::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Company::class);

        return Inertia::render('Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

        $request->validate([
            'name' => ['required', 'string', 'max:20'],
        ], [
            'name.required' => 'O nome da empresa é obrigatório.',
            'name.string' => 'O nome da empresa deve ser um texto válido.',
            'name.max' => 'O nome da empresa não pode ultrapassar 20 caracteres.',
        ]);

        Company::create([
            'name' => $request->name,
        ]);

        return redirect()->route('companies.index')->with('success', 'Empresa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrFail($id);

        $this->authorize('view', $company);

        return inertia('Companies/Show', [
            'company' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return inertia('Companies/Edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $request->validate([
            'name' => ['required', 'string', 'max:20'],
        ], [
            'name.required' => 'O nome da empresa é obrigatório.',
            'name.string' => 'O nome da empresa deve ser um texto válido.',
            'name.max' => 'O nome da empresa não pode ultrapassar 20 caracteres.',
        ]);

        $company->update($request->only('name'));

        return redirect()
            ->route('companies.index')
            ->with('success', 'Empresa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return redirect()
            ->route('companies.index');
    }
}
