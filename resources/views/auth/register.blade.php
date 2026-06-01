<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — CandidatureTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">

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
                    Commencez dès aujourd'hui
                </h2>
                <p class="text-primary-100 leading-relaxed">
                    Rejoignez des centaines de candidats qui organisent leur recherche
                    d'emploi avec CandidatureTracker.
                </p>
            </div>

            <div class="space-y-3">
                @foreach([
                    'Suivi complet de vos candidatures',
                    'Gestion de vos entretiens',
                    'Filtres et archives intelligents',
                ] as $feature)
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 bg-white/20 rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm text-primary-100">{{ $feature }}</span>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- RIGHT PANEL --}}
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-8 lg:px-12 py-10">
            <div class="max-w-sm w-full mx-auto">

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Créer un compte</h1>
                <p class="text-sm text-gray-500 mb-7">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}" class="text-primary-600 font-medium hover:underline">
                        Se connecter
                    </a>
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="form-label">Nom complet</label>
                        <input id="name" type="text" name="name"
                               value="{{ old('name') }}" required autofocus
                               placeholder="Jean Dupont"
                               class="form-input @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <input id="email" type="email" name="email"
                               value="{{ old('email') }}" required
                               placeholder="vous@exemple.fr"
                               class="form-input @error('email') border-red-300 @enderror">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               placeholder="Minimum 8 caractères"
                               class="form-input @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input id="password_confirmation" type="password"
                               name="password_confirmation" required
                               placeholder="Répétez votre mot de passe"
                               class="form-input">
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-2.5">
                        Créer mon compte
                    </button>

                </form>

            </div>
        </div>

    </div>

</body>
</html>