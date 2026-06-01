<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajouter une candidature
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('applications.store') }}">
                    @csrf

                    {{-- Entreprise --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Nom de l'entreprise <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="company_name"
                               value="{{ old('company_name') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('company_name') border-red-500 @enderror">
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Poste --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Poste visé <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="position"
                               value="{{ old('position') }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('position') border-red-500 @enderror">
                        @error('position')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- URL de l'offre --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            URL de l'offre
                        </label>
                        <input type="url" name="offer_url"
                               value="{{ old('offer_url') }}"
                               placeholder="https://..."
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('offer_url') border-red-500 @enderror">
                        @error('offer_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Statut et Priorité --}}
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Statut <span class="text-red-500">*</span>
                            </label>
                            <select name="status"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">
                                @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                                    <option value="{{ $value }}" {{ old('status', 'wishlist') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Priorité <span class="text-red-500">*</span>
                            </label>
                            <select name="priority"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">
                                @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                                    <option value="{{ $value }}" {{ old('priority', 'medium') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('priority')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Date de candidature --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Date de candidature <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="applied_at"
                               value="{{ old('applied_at', now()->format('Y-m-d')) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('applied_at') border-red-500 @enderror">
                        @error('applied_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Notes
                        </label>
                        <textarea name="notes" rows="4"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Boutons --}}
                    <div class="flex gap-3">
                        <button type="submit"
                                class="px-6 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                            Enregistrer
                        </button>
                        <a href="{{ route('applications.index') }}"
                           class="px-6 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>