<x-app-layout>

    <x-slot name="header">
        <h1 class="page-title">Tableau de bord</h1>
    </x-slot>

    {{-- Greeting --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">
            Bonjour, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h2>
        <p class="text-sm text-gray-500 mt-0.5">
            Voici un résumé de votre recherche d'emploi.
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

        @php
            $total      = Auth::user()->applications()->count();
            $interviews = Auth::user()->applications()->where('status', 'interview')->count();
            $offers     = Auth::user()->applications()->where('status', 'offer')->count();
            $accepted   = Auth::user()->applications()->where('status', 'accepted')->count();
        @endphp

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total</p>
                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $total }}</p>
            <p class="text-xs text-gray-400 mt-1">Candidatures</p>
        </div>

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Entretiens</p>
                <div class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $interviews }}</p>
            <p class="text-xs text-gray-400 mt-1">En cours</p>
        </div>

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Offres</p>
                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $offers }}</p>
            <p class="text-xs text-gray-400 mt-1">Reçues</p>
        </div>

        <div class="card p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Acceptées</p>
                <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $accepted }}</p>
            <p class="text-xs text-gray-400 mt-1">Offres acceptées</p>
        </div>

    </div>

    {{-- Recent Applications --}}
    <div class="card">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-900">Candidatures récentes</h3>
            <a href="{{ route('applications.index') }}"
               class="text-xs text-primary-600 font-medium hover:underline">
                Voir tout →
            </a>
        </div>

        @php
            $recentApplications = Auth::user()
                ->applications()
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        @endphp

        @forelse($recentApplications as $application)
            <div class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors
                        {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center shrink-0">
                        <span class="text-xs font-semibold text-gray-600">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $application->company_name }}</p>
                        <p class="text-xs text-gray-400">{{ $application->position }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @php
                        $colors = [
                            'wishlist'  => 'bg-purple-50 text-purple-700',
                            'applied'   => 'bg-blue-50 text-blue-700',
                            'interview' => 'bg-orange-50 text-orange-700',
                            'offer'     => 'bg-green-50 text-green-700',
                            'rejected'  => 'bg-red-50 text-red-700',
                            'accepted'  => 'bg-emerald-50 text-emerald-700',
                        ];
                        $colorClass = $colors[$application->status] ?? 'bg-gray-50 text-gray-700';
                    @endphp
                    <span class="badge {{ $colorClass }}">
                        {{ $application->status_label }}
                    </span>
                    <a href="{{ route('applications.show', $application) }}"
                       class="text-gray-300 hover:text-primary-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="px-5 py-12 text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-900 mb-1">Aucune candidature</p>
                <p class="text-xs text-gray-400 mb-4">Commencez par ajouter votre première candidature.</p>
                <a href="{{ route('applications.create') }}" class="btn-primary text-xs">
                    + Ajouter une candidature
                </a>
            </div>
        @endforelse

    </div>

</x-app-layout>