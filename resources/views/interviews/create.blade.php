<x-app-layout>

    <x-slot name="header">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('applications.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Candidatures</a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('applications.show', $application) }}" class="text-gray-500 hover:text-gray-700 transition-colors">{{ $application->company_name }}</a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-semibold">Nouvel entretien</span>
        </nav>
    </x-slot>

    <div class="max-w-2xl">
        <div class="card p-6">

            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900">Planifier un entretien</h2>
                <p class="text-sm text-gray-500 mt-1">Pour <span class="font-semibold text-gray-700">{{ $application->company_name }}</span></p>
            </div>

            <form method="POST" action="{{ route('interviews.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="application_id" value="{{ $application->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Type d'entretien <span class="text-red-400">*</span></label>
                        <select name="type" class="form-input">
                            @foreach(App\Models\Interview::TYPE_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('type') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('type') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Résultat <span class="text-red-400">*</span></label>
                        <select name="result" class="form-input">
                            @foreach(App\Models\Interview::RESULT_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('result', 'pending') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('result') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="form-label">Date et heure <span class="text-red-400">*</span></label>
                    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}"
                           class="{{ $errors->has('scheduled_at') ? 'form-input-error' : 'form-input' }}">
                    @error('scheduled_at') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="form-label">Notes de préparation</label>
                    <textarea name="notes" rows="4" placeholder="Questions à poser, points à préparer..."
                              class="form-input resize-none">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <a href="{{ route('applications.show', $application) }}" class="btn-secondary">Annuler</a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>