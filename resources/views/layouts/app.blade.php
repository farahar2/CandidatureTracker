<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CandidatureTracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gray-50" x-data="{ sidebarOpen: false }">

    <div class="flex h-full">

        {{-- ===== SIDEBAR DESKTOP ===== --}}
        <aside class="hidden lg:flex lg:flex-col w-60 shrink-0 bg-white border-r border-gray-200 fixed inset-y-0 left-0 z-30">

            {{-- Logo --}}
            <div class="flex items-center h-16 px-5 border-b border-gray-100 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-base font-bold text-gray-900">CandidatureTracker</span>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto">

                <p class="px-3 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
                    Principal
                </p>

                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                        <polyline stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  points="9 22 9 12 15 12 15 22"/>
                    </svg>
                    Tableau de bord
                </a>

                <a href="{{ route('applications.index') }}"
                   class="{{ request()->routeIs('applications.index', 'applications.show', 'applications.edit') ? 'nav-link-active' : 'nav-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Mes candidatures
                </a>

                <a href="{{ route('applications.create') }}"
                   class="{{ request()->routeIs('applications.create') ? 'nav-link-active' : 'nav-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke-width="1.75"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v8M8 12h8"/>
                    </svg>
                    Nouvelle candidature
                </a>

                <div class="pt-4 mt-2">
                    <p class="px-3 mb-2 text-[10px] font-semibold text-gray-400 uppercase tracking-widest">
                        Gestion
                    </p>

                    <a href="{{ route('applications.archived') }}"
                       class="{{ request()->routeIs('applications.archived') ? 'nav-link-active' : 'nav-link' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Archives
                    </a>
                </div>

            </nav>

            {{-- User info --}}
            <div class="shrink-0 px-3 py-4 border-t border-gray-100">
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center shrink-0">
                        <span class="text-xs font-bold text-blue-700">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate leading-none mb-0.5">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-gray-400 truncate leading-none">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Se déconnecter"
                                class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- ===== MOBILE OVERLAY ===== --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/40 backdrop-blur-sm z-20 lg:hidden"
             style="display: none;">
        </div>

        {{-- ===== MOBILE SIDEBAR ===== --}}
        <aside x-show="sidebarOpen"
               x-transition:enter="transition transform duration-200"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition transform duration-200"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-30 flex flex-col lg:hidden shadow-xl"
               style="display: none;">

            <div class="flex items-center justify-between h-16 px-5 border-b border-gray-100">
                <span class="text-base font-bold text-gray-900">CandidatureTracker</span>
                <button @click="sidebarOpen = false"
                        class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-3 py-5 space-y-0.5">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'nav-link-active' : 'nav-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                    Tableau de bord
                </a>
                <a href="{{ route('applications.index') }}"
                   class="{{ request()->routeIs('applications.*') ? 'nav-link-active' : 'nav-link' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Mes candidatures
                </a>
                <a href="{{ route('applications.create') }}" class="nav-link">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouvelle candidature
                </a>
                <a href="{{ route('applications.archived') }}" class="nav-link">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    Archives
                </a>
            </nav>

            <div class="px-3 py-4 border-t border-gray-100">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-xs font-bold text-blue-700">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </span>
                    </div>
                    <p class="text-sm font-semibold text-gray-900 truncate flex-1">{{ Auth::user()->name }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="flex-1 flex flex-col min-h-full lg:ml-60">

            {{-- TOPBAR --}}
            <header class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-200 shrink-0">
                <div class="flex items-center h-16 px-4 sm:px-6 lg:px-8 gap-4">

                    <button @click="sidebarOpen = true"
                            class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div class="flex-1 min-w-0">
                        @isset($header)
                            <div class="animate-fade-in">
                                {{ $header }}
                            </div>
                        @endisset
                    </div>

                </div>
            </header>

            {{-- PAGE CONTENT --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8 animate-fade-up">

                @if(session('success'))
                    <div class="alert-success mb-6"
                         x-data="{ show: true }"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 4000)"
                         x-transition:leave="transition-opacity duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-error mb-6">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
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