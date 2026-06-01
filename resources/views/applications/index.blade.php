<x-app-layout>

    <x-slot name="header">
        <h1 class="text-lg font-bold text-gray-900">Mes candidatures</h1>
    </x-slot>

    {{-- Filters --}}
    <div class="card px-5 py-4 mb-6 animate-fade-up">
        <form method="GET" action="{{ route('applications.index') }}"
              class="flex flex-wrap items-end gap-4">

            <div class="flex-1 min-w-[160px]">
                <label class="form-label text-xs">Statut</label>
                <select name="status" class="form-input py-2.5 text-sm">
                    <option value="">Tous les statuts</option>
                    @foreach(App\Models\Application::STATUS_LABELS as $value => $label)
                        <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-[160px]">
                <label class="form-label text-xs">Priorité</label>
                <select name="priority" class="form-input py-2.5 text-sm">
                    <option value="">Toutes</option>
                    @foreach(App\Models\Application::PRIORITY_LABELS as $value => $label)
                        <option value="{{ $value }}" {{ request('priority') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="btn-primary py-2.5">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Filtrer
                </button>
                @if(request('status') || request('priority'))
                    <a href="{{ route('applications.index') }}" class="btn-ghost py-2.5">
                        <i data-lucide="x" class="w-4 h-4"></i>
                        Effacer
                    </a>
                @endif
            </div>

        </form>
    </div>

    {{-- Results count --}}
    <div class="flex items-center justify-between mb-4 animate-fade-up-delay-1">
        <p class="text-sm text-gray-500">
            <span class="font-bold text-gray-900">{{ $applications->count() }}</span> candidature(s)
        </p>
    </div>

    {{-- Applications Grid --}}
    @forelse($applications as $application)

        @php
            $statusStyles = [
                'wishlist'  => 'bg-purple-50 text-purple-700 border-purple-200',
                'applied'   => 'bg-blue-50 text-blue-700 border-blue-200',
                'interview' => 'bg-orange-50 text-orange-700 border-orange-200',
                'offer'     => 'bg-green-50 text-green-700 border-green-200',
                'rejected'  => 'bg-red-50 text-red-700 border-red-200',
                'accepted'  => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ];
            $priorityStyles = [
                'low'    => 'bg-gray-50 text-gray-600 border-gray-200',
                'medium' => 'bg-blue-50 text-blue-600 border-blue-200',
                'high'   => 'bg-red-50 text-red-600 border-red-200',
            ];
        @endphp

        <div class="card group hover:shadow-card-hover hover:border-gray-200 hover:-translate-y-0.5 transition-all duration-300 mb-3 animate-fade-up-delay-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between p-5 gap-4">

                {{-- Left --}}
                <div class="flex items-center gap-4 flex-1 min-w-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <span class="text-sm font-bold text-indigo-600">
                            {{ strtoupper(substr($application->company_name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-sm font-bold text-gray-900">
                                {{ $application->company_name }}
                            </h3>
                            <span class="badge border {{ $statusStyles[$application->status] ?? '' }}">
                                {{ $application->status_label }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 truncate mt-0.5">{{ $application->position }}</p>
                    </div>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-4 shrink-0">

                    <span class="badge border {{ $priorityStyles[$application->priority] ?? '' }}">
                        {{ $application->priority_label }}
                    </span>

                    <span class="text-xs text-gray-400 hidden md:block">
                        {{ $application->applied_at->format('d/m/Y') }}
                    </span>

                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('applications.show', $application) }}"
                           class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Voir">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                        <a href="{{ route('applications.edit', $application) }}"
                           class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-xl transition-all" title="Modifier">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                        </a>
                        <form method="POST" action="{{ route('applications.destroy', $application) }}"
                              onsubmit="return confirm('Archiver cette candidature ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all" title="Archiver">
                                <i data-lucide="archive" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @empty
        <div class="card py-20 text-center animate-fade-up">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
            </div>
            <p class="text-base font-bold text-gray-900 mb-1">Aucune candidature</p>
            <p class="text-sm text-gray-400 mb-6">
                @if(request('status') || request('priority'))
                    Aucun résultat pour ces filtres.
                @else
                    Ajoutez votre première candidature pour commencer.
                @endif
            </p>
            <a href="{{ route('applications.create') }}" class="btn-primary">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Nouvelle candidature
            </a>
        </div>
    @endforelse

</x-app-layout>