<x-app-layout>

    <x-slot name="header">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('applications.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Candidatures</a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-semibold">Nouvelle candidature</span>
        </nav>
    </x-slot>

    <div class="max-w-2xl">
        <div class="card p-6">

            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900">Nouvelle candidature</h2>
                <p class="text-sm text-gray-500 mt-1">Renseignez les informations du poste.</p>
            </div>

            <form method="POST" action="{{ route('applications.store') }}" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="form-label">Entreprise <span class="text-red-400">*</span></label>
                        <input type="text" name="company_name" value="{{ old('company_name') }}" placeholder="Ex : Google"
                               class="{{ $errors->has('company_name') ? 'form-input-error' : 'form-input' }}">
                        @error('company_name') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Poste visé <span class="text-red-400">*</span></label>
                        <input type="text" name="position" value="{{ old('position') }}" placeholder="Ex : Développeur Laravel"
                               class="{{ $errors->has('position') ? 'form-input-error' : 'form-input' }}">
                        @error('position') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="form-label">URL de l'offre</label>
                    <input type="url" name="offer_url" value="{{ old('offer_url') }}" placeholder="https://..."
                           class="{{ $errors->has('offer_url') ? 'form-input-error' : 'form-input' }}">
                    @error('offer_url') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="form-label">Statut <span class="text-red-400">*</span></label>
                        <select name="status" class="form-input">
                            @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('status', 'wishlist') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Priorité <span class="text-red-400">*</span></label>
                        <select name="priority" class="form-input">
                            @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('priority', 'medium') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('priority') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Date <span class="text-red-400">*</span></label>
                        <input type="date" name="applied_at" value="{{ old('applied_at', now()->format('Y-m-d')) }}"
                               class="{{ $errors->has('applied_at') ? 'form-input-error' : 'form-input' }}">
                        @error('applied_at') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="4" placeholder="Informations complémentaires..."
                              class="form-input resize-none">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <a href="{{ route('applications.index') }}" class="btn-secondary">Annuler</a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>