<x-app-layout>

    <x-slot name="header">
        <h1 class="page-title">Archives</h1>
    </x-slot>

    <div class="card overflow-hidden">

        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div>
                <h3 class="section-title">Candidatures archivées</h3>
                <p class="text-xs text-gray-400 mt-0.5">{{ $applications->count() }} archivée(s)</p>
            </div>
            <a href="{{ route('applications.index') }}" class="btn-ghost btn-sm">← Retour</a>
        </div>

        @forelse($applications as $application)
            <div class="flex flex-col sm:flex-row sm:items-center justify-between px-5 py-4 hover:bg-gray-50 transition-colors {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-xs font-bold text-gray-500">{{ strtoupper(substr($application->company_name, 0, 2)) }}</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $application->company_name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $application->position }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-3 sm:mt-0 shrink-0 flex-wrap">
                    <span class="badge-{{ $application->status }}">{{ $application->status_label }}</span>
                    <span class="text-xs text-gray-400 whitespace-nowrap">Archivé le {{ $application->deleted_at->format('d/m/Y') }}</span>
                    <form method="POST" action="{{ route('applications.restore', $application) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn-success btn-sm">Restaurer</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="py-16 text-center">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-900 mb-1">Aucune archive</p>
                <p class="text-xs text-gray-400">Les candidatures archivées apparaîtront ici.</p>
            </div>
        @endforelse

    </div>

</x-app-layout>