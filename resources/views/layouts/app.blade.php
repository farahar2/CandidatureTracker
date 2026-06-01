<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CandidatureTracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50/50 antialiased">

<div class="flex h-full" x-data="{ sidebarOpen: false }">

    {{-- ===== SIDEBAR — DESKTOP ===== --}}
    <aside class="hidden lg:flex lg:flex-col lg:w-[260px] lg:fixed lg:inset-y-0 bg-white border-r border-gray-100 z-30">

        {{-- Logo --}}
        <div class="flex items-center h-16 px-5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:shadow-indigo-500/30 transition-shadow">
                    <i data-lucide="clipboard-check" class="w-5 h-5 text-white"></i>
                </div>
                <span class="text-base font-bold text-gray-900">CandidatureTracker</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">

            <p class="px-3 mb-2 text-[11px] font-semibold text-gray-400 uppercase tracking-widest">
                Principal
            </p>

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 shrink-0"></i>
                Tableau de bord
            </a>

            <a href="{{ route('applications.index') }}"
               class="{{ request()->routeIs('applications.index', 'applications.show') ? 'nav-item-active' : 'nav-item' }}">
                <i data-lucide="file-text" class="w-5 h-5 shrink-0"></i>
                Mes candidatures
            </a>

            <a href="{{ route('applications.create') }}"
               class="{{ request()->routeIs('applications.create') ? 'nav-item-active' : 'nav-item' }}">
                <i data-lucide="plus-circle" class="w-5 h-5 shrink-0"></i>
                Nouvelle candidature
            </a>

            <div class="pt-4 mt-4 border-t border-gray-100">
                <p class="px-3 mb-2 text-[11px] font-semibold text-gray-400 uppercase tracking-widest">
                    Gestion
                </p>

                <a href="{{ route('applications.archived') }}"
                   class="{{ request()->routeIs('applications.archived') ? 'nav-item-active' : 'nav-item' }}">
                    <i data-lucide="archive" class="w-5 h-5 shrink-0"></i>
                    Archives
                </a>
            </div>

        </nav>

        {{-- User --}}
        <div class="px-3 py-4 border-t border-gray-100">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group cursor-pointer"
                 x-data="{ open: false }" @click="open = !open">

                <div class="w-9 h-9 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-xl flex items-center justify-center shrink-0">
                    <span class="text-xs font-bold text-indigo-700">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </span>
                </div>

                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Déconnexion"
                            class="text-gray-300 hover:text-red-500 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
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
         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-20 lg:hidden"
         @click="sidebarOpen = false">
    </div>

    {{-- MOBILE SIDEBAR --}}
    <aside x-show="sidebarOpen"
           x-transition:enter="transition ease-out duration-200 transform"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200 transform"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 w-72 bg-white border-r border-gray-100 z-30 lg:hidden shadow-xl">

        <div class="flex items-center justify-between h-16 px-5">
            <span class="text-base font-bold text-gray-900">CandidatureTracker</span>
            <button @click="sidebarOpen = false" class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <nav class="px-3 py-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                Tableau de bord
            </a>
            <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.*') ? 'nav-item-active' : 'nav-item' }}">
                <i data-lucide="file-text" class="w-5 h-5"></i>
                Mes candidatures
            </a>
            <a href="{{ route('applications.create') }}" class="nav-item">
                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                Nouvelle candidature
            </a>
            <a href="{{ route('applications.archived') }}" class="nav-item">
                <i data-lucide="archive" class="w-5 h-5"></i>
                Archives
            </a>
        </nav>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="flex-1 flex flex-col lg:pl-[260px]">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-10 flex items-center h-16 px-4 sm:px-6 bg-white/80 backdrop-blur-xl border-b border-gray-100 gap-4">

            <button @click="sidebarOpen = true"
                    class="lg:hidden p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            <div class="flex-1">
                @isset($header)
                    {{ $header }}
                @endisset
            </div>

        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 px-4 sm:px-6 py-6 animate-fade-in">

            @if(session('success'))
                <div class="mb-5 flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm animate-fade-up"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform translate-y-0"
                     x-transition:leave-end="opacity-0 transform -translate-y-2">
                    <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm animate-fade-up">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

        </main>

    </div>

</div>

</body>
</html>