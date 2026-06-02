<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — CandidatureTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 antialiased">

    <div class="flex min-h-screen">

        {{-- Left — Visual --}}
        <div class="hidden lg:flex lg:w-1/2 bg-blue-600 flex-col justify-between p-12">

            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <span class="text-lg font-bold text-white">CandidatureTracker</span>
            </a>

            <div>
                <h2 class="text-3xl font-bold text-white mb-4">
                    Rejoignez des centaines<br>de candidats organisés
                </h2>
                <div class="space-y-3 mt-6">
                    @foreach(['Suivi illimité de candidatures', 'Gestion complète des entretiens', 'Filtres et archives intelligents'] as $feature)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm text-blue-100">{{ $feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div></div>

        </div>

        {{-- Right — Form --}}
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-8 lg:px-16 py-12">
            <div class="max-w-sm w-full mx-auto">

                <div class="lg:hidden mb-10">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-gray-900">CandidatureTracker</span>
                    </a>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Créer un compte</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Se connecter
                    </a>
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="form-label">Nom complet</label>
                        <input id="name" type="text" name="name"
                               value="{{ old('name') }}" required autofocus
                               placeholder="Jean Dupont"
                               class="{{ $errors->has('name') ? 'form-input-error' : 'form-input' }}">
                        @error('name')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <input id="email" type="email" name="email"
                               value="{{ old('email') }}" required
                               placeholder="vous@exemple.fr"
                               class="{{ $errors->has('email') ? 'form-input-error' : 'form-input' }}">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="password" name="password"
                               required autocomplete="new-password"
                               placeholder="Minimum 8 caractères"
                               class="{{ $errors->has('password') ? 'form-input-error' : 'form-input' }}">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               required autocomplete="new-password"
                               placeholder="Confirmez votre mot de passe"
                               class="form-input">
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">
                        Créer mon compte
                    </button>

                    <p class="text-xs text-gray-400 text-center">
                        En créant un compte, vous acceptez nos conditions d'utilisation.
                    </p>

                </form>

            </div>
        </div>

    </div>

</body>
</html>
