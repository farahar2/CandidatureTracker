<x-app-layout>

    <x-slot name="header">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('applications.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">Candidatures</a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-900 font-semibold truncate max-w-xs">{{ $application->company_name }}</span>
        </nav>
    </x-slot>

    <div class="max-w-4xl space-y-6">

        {{-- Header --}}
        <div class="card p-6">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center shrink-0">
                        <span class="text-xl font-bold text-blue-600">{{ strtoupper(substr($application->company_name, 0, 2)) }}</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <h1 class="text-xl font-bold text-gray-900">{{ $application->company_name }}</h1>
                            <a href="{{ $application->offer_url }}" target="_blank" class="text-blue-600 hover:text-blue-700 transition-colors" title="Voir l'offre">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                        <p class="text-sm text-gray-500">{{ $application->position }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <span class="badge-{{ $application->status }}">{{ $application->status_label }}</span>
                    <span class="badge-{{ $application->priority }}">{{ $application->priority_label }}</span>
                    <div class="w-px h-5 bg-gray-200 mx-1"></div>
                    <a href="{{ route('applications.edit', $application) }}"
                       class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Modifier">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('applications.destroy', $application) }}" onsubmit="return confirm('Archiver cette candidature ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Archiver">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                      d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex items-center gap-4 mt-4 pt-4 border-t border-gray-100 text-sm text-gray-500">
                <span>Postulé le <strong class="text-gray-900">{{ $application->applied_at->format('d/m/Y') }}</strong></span>
                @if($application->offer_url)
                    <a href="{{ $application->offer_url }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-medium">
                        Voir l'offre →
                    </a>
                @endif
            </div>
        </div>

        {{-- Notes --}}
        @if($application->notes)
            <div class="card p-6">
                <h3 class="section-title mb-3">Notes</h3>
                <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $application->notes }}</p>
            </div>
        @endif

        {{-- Interviews --}}
        <div class="card overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div>
                    <h3 class="section-title">Entretiens</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $application->interviews->count() }} entretien(s)</p>
                </div>
                <a href="{{ route('interviews.create', ['application' => $application->id]) }}" class="btn-primary btn-sm">+ Ajouter</a>
            </div>

            @forelse($application->interviews as $interview)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between px-5 py-4 hover:bg-gray-50 transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-9 h-9 bg-blue-50 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-semibold text-gray-900">{{ $interview->type_label }}</p>
                                <span class="badge-{{ $interview->result }}">{{ $interview->result_label }}</span>
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $interview->scheduled_at->format('d/m/Y à H:i') }}</p>
                            @if($interview->notes)
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $interview->notes }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-1 mt-3 sm:mt-0 shrink-0">
                        <a href="{{ route('interviews.edit', $interview) }}"
                           class="p-1.5 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Modifier">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('interviews.destroy', $interview) }}" onsubmit="return confirm('Supprimer cet entretien ?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Supprimer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-10 text-center">
                    <p class="text-sm text-gray-400">Aucun entretien enregistré.</p>
                    <a href="{{ route('interviews.create', ['application' => $application->id]) }}"
                       class="inline-flex items-center gap-1 text-xs text-blue-600 font-medium mt-2 hover:underline">
                        + Planifier un entretien
                    </a>
                </div>
            @endforelse
        </div>

    </div>

</x-app-layout>