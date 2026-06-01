<x-app-layout>

    <x-slot name="header">
        <h1 class="page-title">Archives</h1>
    </x-slot>

    <div class="card overflow-hidden">

        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div>
                <h3 class="text-sm font-semibold text-gray-900">Candidatures archivées</h3>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $applications->count() }} candidature(s) archivée(s)
                </p>
            </div>
            <a href="{{ route('applications.index') }}" class="btn-secondary text-xs">
                ← Retour
            </a>
        </div>

        @forelse($applications as $application)

            @php
                $statusColors = [
                    'wishlist'  => 'bg-purple-50 text-purple-700',
                    'applied'   => 'bg-blue-50 text-blue-700',
                    'interview' => 'bg-orange-50 text-orange-700',
                    'offer'     => 'bg-green-50 text-green-700',
                    'rejected'  => 'bg-red-50 text-red-700',
                    'accepted'  => 'bg-emerald-50 text-emerald-700',
                ];
            @endphp

            <div class="flex flex-col sm:flex-row sm:items-center justify-between
                        px-5 py-4 hover:bg-gray-50 transition-colors
                        {{ !$loop->last ? 'border-b border-gray-100' : '' }}">

                <div class="flex items-center gap-4">
                    <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-xs font-bold text-gray-500">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">{{ $application->company_name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $application->position }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-3 sm:mt-0">
                    <span class="badge {{ $statusColors[$application->status] ?? 'bg-gray-50 text-gray-600' }}">
                        {{ $application->status_label }}
                    </span>
                    <span class="text-xs text-gray-400">
                        Archivé le {{ $application->deleted_at->format('d/m/Y') }}
                    </span>
                    <form method="POST" action="{{ route('applications.restore', $application) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-success text-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Restaurer
                        </button>
                    </form>
                </div>

            </div>

        @empty
            <div class="py-16 text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <p class="text-sm font-medium text-gray-900 mb-1">Aucune archive</p>
                <p class="text-xs text-gray-400">
                    Les candidatures archivées apparaîtront ici.
                </p>
            </div>
        @endforelse

    </div>

</x-app-layout>