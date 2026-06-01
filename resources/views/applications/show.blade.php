<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $application->company_name }} — {{ $application->position }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('applications.edit', $application) }}"
                   class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-md hover:bg-yellow-600">
                    Modifier
                </a>
                <form method="POST" action="{{ route('applications.destroy', $application) }}"
                      onsubmit="return confirm('Archiver cette candidature ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700">
                        Archiver
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Message de succès --}}
            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Informations de la candidature --}}
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informations</h3>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Entreprise</p>
                        <p class="font-medium text-gray-900">{{ $application->company_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Poste visé</p>
                        <p class="font-medium text-gray-900">{{ $application->position }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Statut</p>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            bg-{{ $application->status_color }}-100
                            text-{{ $application->status_color }}-800">
                            {{ $application->status_label }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Priorité</p>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            bg-{{ $application->priority_color }}-100
                            text-{{ $application->priority_color }}-800">
                            {{ $application->priority_label }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date de candidature</p>
                        <p class="font-medium text-gray-900">{{ $application->applied_at->format('d/m/Y') }}</p>
                    </div>
                    @if($application->offer_url)
                    <div>
                        <p class="text-sm text-gray-500">Offre d'emploi</p>
                        <a href="{{ $application->offer_url }}" target="_blank"
                           class="text-blue-600 hover:underline text-sm">
                            Voir l'offre →
                        </a>
                    </div>
                    @endif
                </div>

                @if($application->notes)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-1">Notes</p>
                    <p class="text-gray-700 bg-gray-50 rounded p-3">{{ $application->notes }}</p>
                </div>
                @endif
            </div>

          {{-- Section Entretiens --}}
<div class="bg-white shadow-sm rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Entretiens</h3>
        <a href="{{ route('interviews.create', ['application' => $application->id]) }}"
           class="px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
            + Ajouter un entretien
        </a>
    </div>

    @forelse($application->interviews as $interview)
        <div class="border border-gray-200 rounded-md p-4 mb-3">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium text-gray-900">
                        {{ $interview->type_label }}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{ $interview->scheduled_at->format('d/m/Y à H:i') }}
                    </p>
                    @if($interview->notes)
                        <p class="text-sm text-gray-600 mt-2">
                            {{ $interview->notes }}
                        </p>
                    @endif
                </div>
                <div class="flex gap-3 items-center">
                    <span class="text-xs px-2 py-1 rounded-full
                        bg-{{ $interview->result_color }}-100
                        text-{{ $interview->result_color }}-800">
                        {{ $interview->result_label }}
                    </span>
                    <a href="{{ route('interviews.edit', $interview) }}"
                       class="text-yellow-600 hover:underline text-sm">
                        Modifier
                    </a>
                    <form method="POST" action="{{ route('interviews.destroy', $interview) }}"
                          onsubmit="return confirm('Supprimer cet entretien ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline text-sm">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-400 text-center py-6">
            Aucun entretien enregistré pour cette candidature.
        </p>
    @endforelse
</div>

            {{-- Retour --}}
            <div>
                <a href="{{ route('applications.index') }}"
                   class="text-gray-600 hover:underline text-sm">
                    ← Retour à mes candidatures
                </a>
            </div>

        </div>
    </div>
</x-app-layout>