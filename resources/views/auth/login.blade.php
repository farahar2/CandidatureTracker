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

        {{-- LEFT — Form --}}
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-8 lg:px-16 py-12">
            <div class="max-w-sm w-full mx-auto animate-fade-up">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 mb-10 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <i data-lucide="clipboard-check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-lg font-bold text-gray-900">CandidatureTracker</span>
                </a>

                <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Bon retour !</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 transition-colors">
                        Créer un compte
                    </a>
                </p>

                @if (session('status'))
                    <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700 flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email"
                                   value="{{ old('email') }}" required autofocus
                                   placeholder="vous@exemple.fr"
                                   class="form-input pl-11 @error('email') border-red-300 focus:ring-red-500/20 focus:border-red-400 @enderror">
                        </div>
                        @error('email')
                            <p class="form-error">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="form-label mb-0">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-xs text-indigo-600 font-medium hover:text-indigo-700 transition-colors">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                        <div class="relative" x-data="{ show: false }">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input id="password"
                                   :type="show ? 'text' : 'password'"
                                   name="password" required
                                   placeholder="••••••••"
                                   class="form-input pl-11 pr-11 @error('password') border-red-300 @enderror">
                            <button type="button"
                                    @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                                <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-2.5">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-4 h-4 text-indigo-600 bg-gray-50 border-gray-300 rounded focus:ring-indigo-500/20 transition">
                        <label for="remember_me" class="text-sm text-gray-600">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit" class="btn-primary w-full py-3">
                        <i data-lucide="log-in" class="w-4 h-4"></i>
                        Se connecter
                    </button>

                </form>

            </div>
        </div>

        {{-- RIGHT — Visual --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-700 relative overflow-hidden">

            {{-- Decorative --}}
            <div class="absolute inset-0 bg-hero-pattern opacity-10"></div>
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white/5 rounded-full blur-2xl"></div>

            <div class="relative flex flex-col justify-between p-12 w-full">

                {{-- Top content --}}
                <div></div>

                {{-- Center content --}}
                <div class="animate-fade-up">
                    <h2 class="text-3xl font-extrabold text-white mb-4 leading-snug">
                        Organisez votre<br>recherche d'emploi<br>
                        <span class="text-indigo-200">comme un pro.</span>
                    </h2>
                    <p class="text-indigo-100 leading-relaxed max-w-md">
                        Suivez chaque candidature, planifiez vos entretiens et
                        gardez le contrôle total sur votre avenir professionnel.
                    </p>
                </div>

                {{-- Bottom stats --}}
                <div class="grid grid-cols-3 gap-4 animate-fade-up-delay-2">
                    @foreach([
                        ['500+', 'Utilisateurs'],
                        ['2000+', 'Candidatures'],
                        ['98%', 'Satisfaction'],
                    ] as [$stat, $label])
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 text-center border border-white/10">
                            <p class="text-xl font-bold text-white">{{ $stat }}</p>
                            <p class="text-xs text-indigo-200 mt-1">{{ $label }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

</body>
</html>