<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CandidatureTracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50">

<div class="flex h-full" x-data="{ sidebarOpen: false }">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="hidden lg:flex lg:flex-col lg:w-60 lg:fixed lg:inset-y-0 bg-white border-r border-gray-100 shadow-sidebar z-30">

        {{-- Logo --}}
        <div class="flex items-center h-16 px-5 border-b border-gray-100">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-base font-semibold text-gray-900">CandidatureTracker</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

            <p class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Principal</p>

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item' }}">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Tableau de bord
            </a>

            <a href="{{ route('applications.index') }}"
               class="{{ request()->routeIs('applications.index') ? 'nav-item-active' : 'nav-item' }}">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Mes candidatures
            </a>

            <a href="{{ route('applications.create') }}"
               class="{{ request()->routeIs('applications.create') ? 'nav-item-active' : 'nav-item' }}">
                <svg class="w-4.5 h-4.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Nouvelle candidature
            </a>

            <div class="pt-3 mt-3 border-t border-gray-100">
                <p class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Archives</p>

                <a href="{{ route('applications.archived') }}"
                   class="{{ request()->routeIs('applications.archived') ? 'nav-item-active' : 'nav-item' }}">
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    Archives
                </a>
            </div>

        </nav>

        {{-- User info en bas --}}
        <div class="px-3 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center shrink-0">
                    <span class="text-xs font-semibold text-primary-700">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Déconnexion"
                            class="text-gray-400 hover:text-red-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- ===== MOBILE SIDEBAR OVERLAY ===== --}}
    <div x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900/50 z-20 lg:hidden"
         @click="sidebarOpen = false">
    </div>

    {{-- MOBILE SIDEBAR --}}
    <aside x-show="sidebarOpen"
           x-transition:enter="transition ease-in-out duration-200 transform"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in-out duration-200 transform"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 flex flex-col w-64 bg-white border-r border-gray-100 z-30 lg:hidden">

        <div class="flex items-center justify-between h-16 px-5 border-b border-gray-100">
            <span class="text-base font-semibold text-gray-900">CandidatureTracker</span>
            <button @click="sidebarOpen = false" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item' }}">
                Tableau de bord
            </a>
            <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.index') ? 'nav-item-active' : 'nav-item' }}">
                Mes candidatures
            </a>
            <a href="{{ route('applications.create') }}" class="nav-item">
                Nouvelle candidature
            </a>
            <a href="{{ route('applications.archived') }}" class="nav-item">
                Archives
            </a>
        </nav>

    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 flex flex-col lg:pl-60">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-10 flex items-center h-16 px-4 sm:px-6 bg-white border-b border-gray-100 gap-4">

            {{-- Mobile menu button --}}
            <button @click="sidebarOpen = true"
                    class="lg:hidden text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Page title --}}
            <div class="flex-1">
                @isset($header)
                    {{ $header }}
                @endisset
            </div>

            {{-- Right actions --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('applications.create') }}"
                   class="btn-primary hidden sm:inline-flex">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouvelle candidature
                </a>
            </div>

        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 px-4 sm:px-6 py-6">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

        </main>

    </div>
</div>

</body>
</html>