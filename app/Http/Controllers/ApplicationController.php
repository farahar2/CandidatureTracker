<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    /**
     * Liste toutes les candidatures actives de l'utilisateur connecté.
     */
    public function index(Request $request): View
    {
        $applications = Application::query()
            ->where('user_id', auth()->id())
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('priority'), function ($query) use ($request) {
                $query->where('priority', $request->priority);
            })
            ->orderBy('applied_at', 'desc')
            ->get();

        return view('applications.index', compact('applications'));
    }

    /**
     * Affiche le formulaire de création d'une candidature.
     */
    public function create(): View
    {
        return view('applications.create');
    }

    /**
     * Enregistre une nouvelle candidature.
     */
    public function store(StoreApplicationRequest $request): RedirectResponse
    {
        Application::create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('applications.index')
            ->with('success', 'Candidature ajoutée avec succès.');
    }

    /**
     * Affiche le détail d'une candidature avec ses entretiens.
     */
    public function show(Application $application): View
    {
        $this->authorize('view', $application);

        $application->load('interviews');

        return view('applications.show', compact('application'));
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(Application $application): View
    {
        $this->authorize('update', $application);

        return view('applications.edit', compact('application'));
    }

    /**
     * Met à jour une candidature.
     */
    public function update(UpdateApplicationRequest $request, Application $application): RedirectResponse
    {
        $this->authorize('update', $application);

        $application->update($request->validated());

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Candidature mise à jour avec succès.');
    }

    /**
     * Archive une candidature (soft delete).
     */
    public function destroy(Application $application): RedirectResponse
    {
        $this->authorize('delete', $application);

        $application->delete();

        return redirect()
            ->route('applications.index')
            ->with('success', 'Candidature archivée avec succès.');
    }

    /**
     * Affiche les candidatures archivées.
     */
    public function archived(): View
    {
        $applications = Application::query()
            ->onlyTrashed()
            ->where('user_id', auth()->id())
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('applications.archived', compact('applications'));
    }

    /**
     * Restaure une candidature archivée.
     */
    public function restore(Application $application): RedirectResponse
    {
        $this->authorize('restore', $application);

        $application->restore();

        return redirect()
            ->route('applications.archived')
            ->with('success', 'Candidature restaurée avec succès.');
    }
}