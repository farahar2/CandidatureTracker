<x-app-layout>

    <x-slot name="header">
        <h1 class="page-title">Mes candidatures</h1>
    </x-slot>

    {{-- Filters Bar --}}
    <div class="card px-4 py-3 mb-5">
        <form method="GET" action="{{ route('applications.index') }}"
              class="flex flex-wrap items-end gap-3">

            <div class="flex-1 min-w-36">
                <label class="form-label">Statut</label>
                <select name="status" class="form-input py-2">
                    <option value="">Tous les statuts</option>
                    @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                        <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-36">
                <label class="form-label">Priorité</label>
                <select name="priority" class="form-input py-2">
                    <option value="">Toutes</option>
                    @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                        <option value="{{ $value }}" {{ request('priority') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary py-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    Filtrer
                </button>
                @if(request('status') || request('priority'))
                    <a href="{{ route('applications.index') }}" class="btn-secondary py-2">
                        Effacer
                    </a>
                @endif
            </div>

        </form>
    </div>

    {{-- Results count --}}
    <div class="flex items-center justify-between mb-3">
        <p class="text-sm text-gray-500">
            <span class="font-medium text-gray-900">{{ $applications->count() }}</span>
            candidature(s)
        </p>
    </div>

    {{-- Applications List --}}
    <div class="card overflow-hidden">

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
                $priorityColors = [
                    'low'    => 'bg-gray-50 text-gray-600',
                    'medium' => 'bg-blue-50 text-blue-600',
                    'high'   => 'bg-red-50 text-red-600',
                ];
                $statusColor   = $statusColors[$application->status] ?? 'bg-gray-50 text-gray-600';
                $priorityColor = $priorityColors[$application->priority] ?? 'bg-gray-50 text-gray-600';
            @endphp

            <div class="flex flex-col sm:flex-row sm:items-center justify-between
                        px-5 py-4 hover:bg-gray-50 transition-colors group
                        {{ !$loop->last ? 'border-b border-gray-100' : '' }}">

                {{-- Left: Company info --}}
                <div class="flex items-center gap-4 flex-1 min-w-0">

                    {{-- Avatar --}}
                    <div class="w-10 h-10 bg-primary-50 rounded-xl flex items-center justify-center shrink-0">
                        <span class="text-sm font-bold text-primary-600">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>

                    {{-- Info --}}
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $application->company_name }}
                            </p>
                            <span class="badge {{ $statusColor }}">
                                {{ $application->status_label }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 truncate mt-0.5">
                            {{ $application->position }}
                        </p>
                    </div>

                </div>

                {{-- Right: Meta + Actions --}}
                <div class="flex items-center gap-4 mt-3 sm:mt-0 sm:pl-4 shrink-0">

                    <span class="badge {{ $priorityColor }}">
                        {{ $application->priority_label }}
                    </span>

                    <span class="text-xs text-gray-400 hidden md:block">
                        {{ $application->applied_at->format('d/m/Y') }}
                    </span>

                    {{-- Actions --}}
                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('applications.show', $application) }}"
                           class="p-1.5 text-gray-400 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors"
                           title="Voir">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                        <a href="{{ route('applications.edit', $application) }}"
                           class="p-1.5 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors"
                           title="Modifier">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('applications.destroy', $application) }}"
                              onsubmit="return confirm('Archiver cette candidature ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Archiver">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        @empty
            <div class="py-16 text-center">
                <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-900 mb-1">Aucune candidature trouvée</p>
                <p class="text-xs text-gray-400 mb-5">
                    @if(request('status') || request('priority'))
                        Aucun résultat pour ces filtres.
                    @else
                        Ajoutez votre première candidature pour commencer.
                    @endif
                </p>
                <a href="{{ route('applications.create') }}" class="btn-primary">
                    + Nouvelle candidature
                </a>
            </div>
        @endforelse

    </div>

</x-app-layout>