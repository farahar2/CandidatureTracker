<x-app-layout>

    <x-slot name="header">
        <h1 class="text-lg font-bold text-gray-900">Tableau de bord</h1>
    </x-slot>

    @php
        $total      = Auth::user()->applications()->count();
        $interviews = Auth::user()->applications()->where('status', 'interview')->count();
        $offers     = Auth::user()->applications()->where('status', 'offer')->count();
        $accepted   = Auth::user()->applications()->where('status', 'accepted')->count();
        $recentApps = Auth::user()->applications()->latest()->take(5)->get();
    @endphp

    {{-- Greeting --}}
    <div class="mb-8 animate-fade-up">
        <h2 class="text-2xl font-extrabold text-gray-900">
            Bonjour, {{ explode(' ', Auth::user()->name)[0] }} 👋
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Voici un résumé de votre recherche d'emploi.
        </p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        @foreach([
            ['Total', $total, 'file-text', 'from-blue-500 to-indigo-600', 'blue'],
            ['Entretiens', $interviews, 'calendar', 'from-orange-500 to-amber-600', 'orange'],
            ['Offres', $offers, 'gift', 'from-emerald-500 to-teal-600', 'emerald'],
            ['Acceptées', $accepted, 'trophy', 'from-purple-500 to-violet-600', 'purple'],
        ] as [$label, $count, $icon, $gradient, $color])

            <div class="card-hover p-5 group animate-fade-up-delay-1">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ $label }}</p>
                    <div class="w-10 h-10 bg-gradient-to-br {{ $gradient }} rounded-xl flex items-center justify-center shadow-lg shadow-{{ $color }}-500/20 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="{{ $icon }}" class="w-5 h-5 text-white"></i>
                    </div>
                </div>
                <p class="text-3xl font-extrabold text-gray-900">{{ $count }}</p>
                <p class="text-xs text-gray-400 mt-1">candidature(s)</p>
            </div>

        @endforeach

    </div>

    {{-- Recent Applications --}}
    <div class="card overflow-hidden animate-fade-up-delay-2">

        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div>
                <h3 class="text-sm font-bold text-gray-900">Candidatures récentes</h3>
                <p class="text-xs text-gray-400 mt-0.5">Vos dernières activités</p>
            </div>
            <a href="{{ route('applications.index') }}" class="btn-ghost text-xs">
                Voir tout
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        @forelse($recentApps as $application)

            @php
                $statusStyles = [
                    'wishlist'  => 'bg-purple-50 text-purple-700 border-purple-200',
                    'applied'   => 'bg-blue-50 text-blue-700 border-blue-200',
                    'interview' => 'bg-orange-50 text-orange-700 border-orange-200',
                    'offer'     => 'bg-green-50 text-green-700 border-green-200',
                    'rejected'  => 'bg-red-50 text-red-700 border-red-200',
                    'accepted'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                ];
            @endphp

            <a href="{{ route('applications.show', $application) }}"
               class="flex items-center justify-between px-6 py-4 hover:bg-gray-50/80 transition-colors
                      {{ !$loop->last ? 'border-b border-gray-50' : '' }} group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <span class="text-xs font-bold text-indigo-600">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $application->company_name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $application->position }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="badge border {{ $statusStyles[$application->status] ?? '' }}">
                        {{ $application->status_label }}
                    </span>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-300 group-hover:text-indigo-500 transition-colors"></i>
                </div>
            </a>

        @empty
            <div class="py-16 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
                </div>
                <p class="text-sm font-semibold text-gray-900 mb-1">Aucune candidature</p>
                <p class="text-xs text-gray-400 mb-5">Commencez par ajouter votre première candidature.</p>
                <a href="{{ route('applications.create') }}" class="btn-primary">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    Ajouter une candidature
                </a>
            </div>
        @endforelse

    </div>

</x-app-layout>