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
            <span class="text-gray-900 font-medium">Modifier</span>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="card p-6">

            <div class="mb-6">
                <h2 class="text-base font-semibold text-gray-900">
                    Modifier — {{ $application->company_name }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    Mettez à jour les informations de cette candidature.
                </p>
            </div>

            <form method="POST" action="{{ route('applications.update', $application) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Entreprise <span class="text-red-400">*</span></label>
                        <input type="text" name="company_name"
                               value="{{ old('company_name', $application->company_name) }}"
                               class="form-input @error('company_name') border-red-300 @enderror">
                        @error('company_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">Poste visé <span class="text-red-400">*</span></label>
                        <input type="text" name="position"
                               value="{{ old('position', $application->position) }}"
                               class="form-input @error('position') border-red-300 @enderror">
                        @error('position')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="form-label">URL de l'offre</label>
                    <input type="url" name="offer_url"
                           value="{{ old('offer_url', $application->offer_url) }}"
                           placeholder="https://..."
                           class="form-input @error('offer_url') border-red-300 @enderror">
                    @error('offer_url')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <div>
                        <label class="form-label">Statut <span class="text-red-400">*</span></label>
                        <select name="status"
                                class="form-input @error('status') border-red-300 @enderror">
                            @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                                <option value="{{ $value }}"
                                        {{ old('status', $application->status) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">Priorité <span class="text-red-400">*</span></label>
                        <select name="priority"
                                class="form-input @error('priority') border-red-300 @enderror">
                            @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                                <option value="{{ $value }}"
                                        {{ old('priority', $application->priority) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">Date <span class="text-red-400">*</span></label>
                        <input type="date" name="applied_at"
                               value="{{ old('applied_at', $application->applied_at->format('Y-m-d')) }}"
                               class="form-input @error('applied_at') border-red-300 @enderror">
                        @error('applied_at')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div>
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="4"
                              class="form-input resize-none">{{ old('notes', $application->notes) }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-primary">
                        Mettre à jour
                    </button>
                    <a href="{{ route('applications.show', $application) }}" class="btn-secondary">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>