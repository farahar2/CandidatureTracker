<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InterviewController extends Controller
{
    /**
     * Affiche le formulaire de création d'un entretien.
     * La candidature est passée en paramètre GET.
     */
    public function create(Request $request): View
    {
        // Récupère la candidature et vérifie qu'elle appartient à l'utilisateur
        $application = Application::where('id', $request->application)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('interviews.create', compact('application'));
    }

    /**
     * Enregistre un nouvel entretien.
     */
    public function store(StoreInterviewRequest $request): RedirectResponse
    {
        // Vérifie que la candidature appartient à l'utilisateur connecté
        $application = Application::where('id', $request->application_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $application->interviews()->create($request->validated());

        return redirect()
            ->route('applications.show', $application)
            ->with('success', 'Entretien ajouté avec succès.');
    }

    /**
     * Affiche le formulaire de modification d'un entretien.
     */
    public function edit(Interview $interview): View
    {
        $this->authorize('update', $interview);

        return view('interviews.edit', compact('interview'));
    }

    /**
     * Met à jour un entretien.
     */
    public function update(UpdateInterviewRequest $request, Interview $interview): RedirectResponse
    {
        $this->authorize('update', $interview);

        $interview->update($request->validated());

        return redirect()
            ->route('applications.show', $interview->application_id)
            ->with('success', 'Entretien mis à jour avec succès.');
    }

    /**
     * Supprime un entretien.
     */
    public function destroy(Interview $interview): RedirectResponse
    {
        $this->authorize('delete', $interview);

        $applicationId = $interview->application_id;

        $interview->delete();

        return redirect()
            ->route('applications.show', $applicationId)
            ->with('success', 'Entretien supprimé avec succès.');
    }
}