<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier l'entretien — {{ $interview->application->company_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <form method="POST" action="{{ route('interviews.update', $interview) }}">
                    @csrf
                    @method('PUT')

                    {{-- Type d'entretien --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Type d'entretien <span class="text-red-500">*</span>
                        </label>
                        <select name="type"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('type') border-red-500 @enderror">
                            @foreach(App\Models\Interview::TYPE_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('type', $interview->type) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date et heure --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Date et heure <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="scheduled_at"
                               value="{{ old('scheduled_at', $interview->scheduled_at->format('Y-m-d\TH:i')) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('scheduled_at') border-red-500 @enderror">
                        @error('scheduled_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Résultat --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Résultat <span class="text-red-500">*</span>
                        </label>
                        <select name="result"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 @error('result') border-red-500 @enderror">
                            @foreach(App\Models\Interview::RESULT_LABELS as $value => $label)
                                <option value="{{ $value }}" {{ old('result', $interview->result) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('result')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Notes de préparation
                        </label>
                        <textarea name="notes" rows="4"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500">{{ old('notes', $interview->notes) }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Boutons --}}
                    <div class="flex gap-3">
                        <button type="submit"
                                class="px-6 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                            Mettre à jour
                        </button>
                        <a href="{{ route('applications.show', $interview->application_id) }}"
                           class="px-6 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300">
                            Annuler
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
