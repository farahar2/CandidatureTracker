<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CandidatureTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                    📋 CandidatureTracker
                </a>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-gray-700 text-sm font-medium hover:text-gray-900">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-gray-800 text-white text-sm font-medium rounded-md hover:bg-gray-700">
                            Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <main class="flex-1 flex items-center justify-center">
        <div class="max-w-3xl mx-auto text-center px-4">
            <h1 class="text-4xl font-bold text-gray-900 mb-6">
                Suivez vos candidatures en un seul endroit
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Centralisez vos candidatures, planifiez vos entretiens
                et ne perdez plus aucune opportunité.
                CandidatureTracker vous aide à organiser votre recherche d'emploi
                de manière simple et efficace.
            </p>

            <div class="flex justify-center gap-4">
                @auth
                    <a href="{{ route('applications.index') }}"
                       class="px-6 py-3 bg-gray-800 text-white font-medium rounded-md hover:bg-gray-700">
                        Mes candidatures
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 bg-gray-800 text-white font-medium rounded-md hover:bg-gray-700">
                        Commencer gratuitement
                    </a>
                    <a href="{{ route('login') }}"
                       class="px-6 py-3 bg-white text-gray-700 font-medium rounded-md border border-gray-300 hover:bg-gray-50">
                        Se connecter
                    </a>
                @endauth
            </div>

            {{-- Fonctionnalités --}}
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 text-left">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-2xl mb-3">📝</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Suivez vos candidatures</h3>
                    <p class="text-sm text-gray-600">
                        Enregistrez chaque candidature avec le poste, l'entreprise,
                        le statut et la priorité.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-2xl mb-3">📅</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Planifiez vos entretiens</h3>
                    <p class="text-sm text-gray-600">
                        Ajoutez vos entretiens, notez vos préparations
                        et suivez les résultats.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="text-2xl mb-3">📊</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Restez organisé</h3>
                    <p class="text-sm text-gray-600">
                        Filtrez par statut et priorité, archivez les candidatures
                        terminées.
                    </p>
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="py-6 text-center text-sm text-gray-400">
        © {{ date('Y') }} CandidatureTracker — Tous droits réservés.
    </footer>

</body>
</html>