<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes candidatures
            </h2>
            <a href="{{ route('applications.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                + Ajouter une candidature
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de succès --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Filtres --}}
            <form method="GET" action="{{ route('applications.index') }}"
                  class="mb-6 flex flex-wrap gap-4 bg-white p-4 rounded-lg shadow-sm">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status"
                            class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-gray-500 focus:border-gray-500">
                        <option value="">Tous</option>
                        @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                            <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                    <select name="priority"
                            class="border-gray-300 rounded-md shadow-sm text-sm focus:ring-gray-500 focus:border-gray-500">
                        <option value="">Toutes</option>
                        @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                            <option value="{{ $value }}" {{ request('priority') === $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="px-4 py-2 bg-gray-800 text-white text-sm rounded-md hover:bg-gray-700">
                        Filtrer
                    </button>
                    <a href="{{ route('applications.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-md hover:bg-gray-300">
                        Réinitialiser
                    </a>
                </div>
            </form>

            {{-- Liste des candidatures --}}
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entreprise</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poste</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Priorité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($applications as $application)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $application->company_name }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $application->position }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        bg-{{ $application->status_color }}-100
                                        text-{{ $application->status_color }}-800">
                                        {{ $application->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        bg-{{ $application->priority_color }}-100
                                        text-{{ $application->priority_color }}-800">
                                        {{ $application->priority_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $application->applied_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 flex gap-3">
                                    <a href="{{ route('applications.show', $application) }}"
                                       class="text-blue-600 hover:underline text-sm">Voir</a>
                                    <a href="{{ route('applications.edit', $application) }}"
                                       class="text-yellow-600 hover:underline text-sm">Modifier</a>
                                    <form method="POST" action="{{ route('applications.destroy', $application) }}"
                                          onsubmit="return confirm('Archiver cette candidature ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline text-sm">
                                            Archiver
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                    Aucune candidature trouvée. 
                                    <a href="{{ route('applications.create') }}" class="text-blue-600 hover:underline">
                                        Ajouter votre première candidature
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>