<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CandidatureTracker — Suivez vos candidatures</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased">

    {{-- ===== NAVBAR ===== --}}
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-base font-semibold text-gray-900">CandidatureTracker</span>
                </a>

                {{-- Actions --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Commencer gratuitement
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    {{-- ===== HERO ===== --}}
    <section class="pt-32 pb-20 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto text-center">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary-50 text-primary-700 text-xs font-medium rounded-full border border-primary-200 mb-6">
                <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                Gratuit — Organisez votre recherche d'emploi
            </div>

            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-5">
                Suivez toutes vos candidatures<br>
                <span class="text-primary-600">en un seul endroit</span>
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg text-gray-500 max-w-2xl mx-auto mb-8 leading-relaxed">
                Centralisez vos candidatures, planifiez vos entretiens et
                ne manquez plus aucune opportunité. Simple, rapide et efficace.
            </p>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                @auth
                    <a href="{{ route('applications.index') }}" class="btn-primary px-6 py-3 text-base">
                        Mes candidatures →
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary px-6 py-3 text-base">
                        Créer mon compte gratuitement
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary px-6 py-3 text-base">
                        Se connecter
                    </a>
                @endauth
            </div>

        </div>
    </section>

    {{-- ===== FEATURES ===== --}}
    <section class="py-16 px-4 sm:px-6 bg-gray-50">
        <div class="max-w-5xl mx-auto">

            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-3">
                    Tout ce dont vous avez besoin
                </h2>
                <p class="text-gray-500">
                    Une solution simple pour ne plus jamais perdre le fil.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                <div class="card p-6">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Suivi des candidatures</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Enregistrez chaque candidature avec le statut, la priorité et toutes les informations importantes.
                    </p>
                </div>

                <div class="card p-6">
                    <div class="w-10 h-10 bg-orange-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Gestion des entretiens</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Planifiez et suivez tous vos entretiens avec des notes de préparation et les résultats.
                    </p>
                </div>

                <div class="card p-6">
                    <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Filtres intelligents</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Filtrez par statut et priorité pour retrouver rapidement n'importe quelle candidature.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="py-8 px-4 border-t border-gray-100">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-primary-600 rounded flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-sm text-gray-500">© {{ date('Y') }} CandidatureTracker</span>
            </div>
        </div>
    </footer>

</body>
</html>