<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — CandidatureTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">

    <div class="flex min-h-screen">

        {{-- LEFT PANEL --}}
        <div class="hidden lg:flex lg:w-1/2 bg-primary-600 flex-col justify-between p-10">

            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold text-white">CandidatureTracker</span>
            </a>

            <div>
                <h2 class="text-3xl font-bold text-white mb-4">
                    Organisez votre<br>recherche d'emploi
                </h2>
                <p class="text-primary-100 leading-relaxed">
                    Centralisez toutes vos candidatures, suivez vos entretiens
                    et ne manquez plus jamais une opportunité.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-2xl font-bold text-white">100%</p>
                    <p class="text-xs text-primary-200 mt-1">Gratuit</p>
                </div>
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-2xl font-bold text-white">∞</p>
                    <p class="text-xs text-primary-200 mt-1">Candidatures</p>
                </div>
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-2xl font-bold text-white">0</p>
                    <p class="text-xs text-primary-200 mt-1">Oubli</p>
                </div>
            </div>

        </div>

        {{-- RIGHT PANEL — FORM --}}
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-8 lg:px-12 py-10">

            <div class="max-w-sm w-full mx-auto">

                {{-- Mobile logo --}}
                <div class="lg:hidden mb-8 flex justify-center">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Connexion</h1>
                <p class="text-sm text-gray-500 mb-7">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-primary-600 font-medium hover:underline">
                        Créer un compte
                    </a>
                </p>

                {{-- Session status --}}
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-sm text-green-700">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <input id="email" type="email" name="email"
                               value="{{ old('email') }}" required autofocus autocomplete="email"
                               placeholder="vous@exemple.fr"
                               class="form-input @error('email') border-red-300 focus:ring-red-500 @enderror">
                        @error('email')
                            <p class="form-error">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="form-label mb-0">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-xs text-primary-600 hover:underline">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password"
                               required autocomplete="current-password"
                               placeholder="••••••••"
                               class="form-input @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                        <label for="remember_me" class="text-sm text-gray-600">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-2.5 text-sm">
                        Se connecter
                    </button>

                </form>

            </div>
        </div>

    </div>

</body>
</html>