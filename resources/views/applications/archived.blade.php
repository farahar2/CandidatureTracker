<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Candidatures archivées
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de succès --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entreprise</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poste</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Archivée le</th>
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
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $application->deleted_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <form method="POST"
                                          action="{{ route('applications.restore', $application) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-green-600 hover:underline text-sm">
                                            Restaurer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    Aucune candidature archivée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('applications.index') }}"
                   class="text-gray-600 hover:underline text-sm">
                    ← Retour à mes candidatures
                </a>
            </div>

        </div>
    </div>
</x-app-layout>