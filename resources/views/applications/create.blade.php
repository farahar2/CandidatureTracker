<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('applications.index') }}" class="hover:text-primary-600 transition-colors">
                Candidatures
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium">Nouvelle candidature</span>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="card p-6">

            <div class="mb-6">
                <h2 class="text-base font-semibold text-gray-900">Informations de la candidature</h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    Renseignez les informations sur le poste et l'entreprise.
                </p>
            </div>

            <form method="POST" action="{{ route('applications.store') }}" class="space-y-5">
                @csrf

                {{-- Company + Position --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">
                            Entreprise <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="company_name"
                               value="{{ old('company_name') }}"
                               placeholder="Ex : Google"
                               class="form-input @error('company_name') border-red-300 @enderror">
                        @error('company_name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">
                            Poste visé <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="position"
                               value="{{ old('position') }}"
                               placeholder="Ex : Développeur Laravel"
                               class="form-input @error('position') border-red-300 @enderror">
                        @error('position')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Offer URL --}}
                <div>
                    <label class="form-label">URL de l'offre</label>
                    <input type="url" name="offer_url"
                           value="{{ old('offer_url') }}"
                           placeholder="https://..."
                           class="form-input @error('offer_url') border-red-300 @enderror">
                    @error('offer_url')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status + Priority + Date --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <div>
                        <label class="form-label">
                            Statut <span class="text-red-400">*</span>
                        </label>
                        <select name="status"
                                class="form-input @error('status') border-red-300 @enderror">
                            @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                                <option value="{{ $value }}"
                                        {{ old('status', 'wishlist') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">
                            Priorité <span class="text-red-400">*</span>
                        </label>
                        <select name="priority"
                                class="form-input @error('priority') border-red-300 @enderror">
                            @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                                <option value="{{ $value }}"
                                        {{ old('priority', 'medium') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">
                            Date <span class="text-red-400">*</span>
                        </label>
                        <input type="date" name="applied_at"
                               value="{{ old('applied_at', now()->format('Y-m-d')) }}"
                               class="form-input @error('applied_at') border-red-300 @enderror">
                        @error('applied_at')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Notes --}}
                <div>
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="4"
                              placeholder="Informations complémentaires, contacts, prochaines étapes..."
                              class="form-input resize-none">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-primary">
                        Enregistrer la candidature
                    </button>
                    <a href="{{ route('applications.index') }}" class="btn-secondary">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>