<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('applications.index') }}" class="hover:text-primary-600 transition-colors">
                Candidatures
            </a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-medium">{{ $application->company_name }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl space-y-5">

        {{-- Header Card --}}
        <div class="card p-5">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">

                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center shrink-0">
                        <span class="text-lg font-bold text-primary-600">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">{{ $application->company_name }}</h1>
                        <p class="text-gray-500 text-sm mt-0.5">{{ $application->position }}</p>
                        <div class="flex items-center gap-2 mt-2 flex-wrap">
                            @php
                                $statusColors = [
                                    'wishlist'  => 'bg-purple-50 text-purple-700',
                                    'applied'   => 'bg-blue-50 text-blue-700',
                                    'interview' => 'bg-orange-50 text-orange-700',
                                    'offer'     => 'bg-green-50 text-green-700',
                                    'rejected'  => 'bg-red-50 text-red-700',
                                    'accepted'  => 'bg-emerald-50 text-emerald-700',
                                ];
                                $priorityColors = [
                                    'low'    => 'bg-gray-50 text-gray-600',
                                    'medium' => 'bg-blue-50 text-blue-600',
                                    'high'   => 'bg-red-50 text-red-600',
                                ];
                            @endphp
                            <span class="badge {{ $statusColors[$application->status] ?? 'bg-gray-50 text-gray-600' }}">
                                {{ $application->status_label }}
                            </span>
                            <span class="badge {{ $priorityColors[$application->priority] ?? 'bg-gray-50 text-gray-600' }}">
                                Priorité {{ $application->priority_label }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 shrink-0">
                    @if($application->offer_url)
                        <a href="{{ $application->offer_url }}" target="_blank" class="btn-secondary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Voir l'offre
                        </a>
                    @endif
                    <a href="{{ route('applications.edit', $application) }}" class="btn-secondary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                    <form method="POST" action="{{ route('applications.destroy', $application) }}"
                          onsubmit="return confirm('Archiver cette candidature ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                            Archiver
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- Info Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="card p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Date de candidature</p>
                <p class="text-sm font-semibold text-gray-900">
                    {{ $application->applied_at->format('d MMMM Y') }}
                </p>
            </div>

            <div class="card p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Statut</p>
                <span class="badge {{ $statusColors[$application->status] ?? 'bg-gray-50 text-gray-600' }}">
                    {{ $application->status_label }}
                </span>
            </div>

            <div class="card p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Priorité</p>
                <span class="badge {{ $priorityColors[$application->priority] ?? 'bg-gray-50 text-gray-600' }}">
                    {{ $application->priority_label }}
                </span>
            </div>

        </div>

        {{-- Notes --}}
        @if($application->notes)
            <div class="card p-5">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Notes</h3>
                <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $application->notes }}
                </p>
            </div>
        @endif

        {{-- Interviews Section --}}
        <div class="card overflow-hidden">

            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-sm font-semibold text-gray-900">Entretiens</h3>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $application->interviews->count() }} entretien(s)
                    </p>
                </div>
                <a href="{{ route('interviews.create', ['application' => $application->id]) }}"
                   class="btn-primary text-xs">
                    + Ajouter
                </a>
            </div>

            @forelse($application->interviews as $interview)

                @php
                    $resultColors = [
                        'pending' => 'bg-gray-50 text-gray-600',
                        'passed'  => 'bg-green-50 text-green-700',
                        'failed'  => 'bg-red-50 text-red-700',
                    ];
                @endphp

                <div class="flex flex-col sm:flex-row sm:items-center justify-between
                            px-5 py-4 hover:bg-gray-50 transition-colors
                            {{ !$loop->last ? 'border-b border-gray-100' : '' }}">

                    <div class="flex items-center gap-4">
                        <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $interview->type_label }}
                            </p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                {{ $interview->scheduled_at->format('d/m/Y à H:i') }}
                            </p>
                            @if($interview->notes)
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">
                                    {{ $interview->notes }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-3 sm:mt-0">
                        <span class="badge {{ $resultColors[$interview->result] ?? 'bg-gray-50 text-gray-600' }}">
                            {{ $interview->result_label }}
                        </span>
                        <a href="{{ route('interviews.edit', $interview) }}"
                           class="p-1.5 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('interviews.destroy', $interview) }}"
                              onsubmit="return confirm('Supprimer cet entretien ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>

            @empty
                <div class="py-10 text-center">
                    <p class="text-sm text-gray-400">Aucun entretien pour cette candidature.</p>
                    <a href="{{ route('interviews.create', ['application' => $application->id]) }}"
                       class="inline-flex items-center gap-1 text-xs text-primary-600 font-medium mt-2 hover:underline">
                        + Planifier un entretien
                    </a>
                </div>
            @endforelse

        </div>

    </div>

</x-app-layout>