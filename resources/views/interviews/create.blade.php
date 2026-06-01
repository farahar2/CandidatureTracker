<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('applications.index') }}" class="hover:text-primary-600 transition-colors">
                Candidatures
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('applications.show', $application) }}"
               class="hover:text-primary-600 transition-colors">
                {{ $application->company_name }}
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium">Nouvel entretien</span>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="card p-6">

            <div class="mb-6">
                <h2 class="text-base font-semibold text-gray-900">Planifier un entretien</h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    Pour la candidature chez
                    <span class="font-medium text-gray-700">{{ $application->company_name }}</span>
                </p>
            </div>

            <form method="POST" action="{{ route('interviews.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="application_id" value="{{ $application->id }}">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">
                            Type d'entretien <span class="text-red-400">*</span>
                        </label>
                        <select name="type"
                                class="form-input @error('type') border-red-300 @enderror">
                            @foreach(App\Models\Interview::TYPE_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('type') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">
                            Résultat <span class="text-red-400">*</span>
                        </label>
                        <select name="result"
                                class="form-input @error('result') border-red-300 @enderror">
                            @foreach(App\Models\Interview::RESULT_LABELS as $value => $label)
                                <option value="{{ $value }}"
                                        {{ old('result', 'pending') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('result')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="form-label">
                        Date et heure <span class="text-red-400">*</span>
                    </label>
                    <input type="datetime-local" name="scheduled_at"
                           value="{{ old('scheduled_at') }}"
                           class="form-input @error('scheduled_at') border-red-300 @enderror">
                    @error('scheduled_at')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Notes de préparation</label>
                    <textarea name="notes" rows="4"
                              placeholder="Questions à poser, points à préparer..."
                              class="form-input resize-none">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-primary">
                        Enregistrer l'entretien
                    </button>
                    <a href="{{ route('applications.show', $application) }}" class="btn-secondary">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>