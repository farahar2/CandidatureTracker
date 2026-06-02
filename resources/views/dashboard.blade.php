<x-app-layout>

    <x-slot name="header">
        <h1 class="page-title">Tableau de bord</h1>
    </x-slot>

    @php
        $stats = [
            'total'     => Auth::user()->applications()->count(),
            'interview' => Auth::user()->applications()->where('status', 'interview')->count(),
            'offer'     => Auth::user()->applications()->where('status', 'offer')->count(),
            'accepted'  => Auth::user()->applications()->where('status', 'accepted')->count(),
        ];
        $recent = Auth::user()->applications()->latest()->take(6)->get();
    @endphp

    {{-- Greeting --}}
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900">
            Bonjour, {{ explode(' ', Auth::user()->name)[0] }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">Voici un aperçu de votre recherche d'emploi.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="card p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Total</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">candidatures envoyées</p>
                </div>
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Entretiens</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['interview'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">programmés ou à venir</p>
                </div>
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Offres</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['offer'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">propositions reçues</p>
                </div>
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="card p-5">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Acceptées</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['accepted'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">offres acceptées</p>
                </div>
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- Recent --}}
    <div class="card overflow-hidden">

        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div>
                <h3 class="section-title">Candidatures récentes</h3>
                <p class="text-xs text-gray-400 mt-0.5">Vos dernières activités</p>
            </div>
            <a href="{{ route('applications.index') }}" class="btn-ghost btn-sm">
                Voir tout →
            </a>
        </div>

        @forelse($recent as $application)
            <a href="{{ route('applications.show', $application) }}"
               class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors group
                      {{ !$loop->last ? 'border-b border-gray-50' : '' }}">

                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-blue-100 transition-colors">
                        <span class="text-xs font-bold text-blue-600">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $application->company_name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $application->position }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 ml-4">
                    <span class="badge-{{ $application->status }}">{{ $application->status_label }}</span>
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>

            </a>
        @empty
            <div class="py-16 text-center">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-900 mb-1">Aucune candidature</p>
                <p class="text-xs text-gray-400 mb-5">Commencez par ajouter votre première candidature.</p>
                <a href="{{ route('applications.create') }}" class="btn-primary btn-sm">+ Ajouter une candidature</a>
            </div>
        @endforelse

    </div>

</x-app-layout>