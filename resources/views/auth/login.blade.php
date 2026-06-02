<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — CandidatureTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 antialiased">

    <div class="flex min-h-screen">

        {{-- Left — Form --}}
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-8 lg:px-16 py-12">
            <div class="max-w-sm w-full mx-auto">

                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-10">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900">CandidatureTracker</span>
                </a>

                <h1 class="text-2xl font-bold text-gray-900 mb-1">Connexion</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-700">
                        Créer un compte
                    </a>
                </p>

                @if (session('status'))
                    <div class="alert-success mb-5">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <input id="email" type="email" name="email"
                               value="{{ old('email') }}" required autofocus
                               placeholder="vous@exemple.fr"
                               class="{{ $errors->has('email') ? 'form-input-error' : 'form-input' }}">
                        @error('email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="form-label mb-0">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-xs text-blue-600 font-medium hover:text-blue-700">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password"
                               required autocomplete="current-password"
                               placeholder="••••••••"
                               class="{{ $errors->has('password') ? 'form-input-error' : 'form-input' }}">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2.5">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember_me" class="text-sm text-gray-600">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center">
                        Se connecter
                    </button>

                </form>

            </div>
        </div>

        {{-- Right — Visual --}}
        <div class="hidden lg:flex lg:w-1/2 bg-blue-600 flex-col justify-between p-12">

            <div></div>

            <div>
                <h2 class="text-3xl font-bold text-white mb-4">
                    Organisez votre<br>recherche d'emploi
                </h2>
                <p class="text-blue-100 leading-relaxed max-w-md">
                    Suivez chaque candidature, planifiez vos entretiens et
                    gardez le contrôle total sur votre avenir professionnel.
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-2xl font-bold text-white">500+</p>
                    <p class="text-xs text-blue-200 mt-1">Utilisateurs</p>
                </div>
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-2xl font-bold text-white">2000+</p>
                    <p class="text-xs text-blue-200 mt-1">Candidatures</p>
                </div>
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-2xl font-bold text-white">98%</p>
                    <p class="text-xs text-blue-200 mt-1">Satisfaction</p>
                </div>
            </div>

        </div>

    </div>

</body>
</html>