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

        {{-- LEFT — Visual --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 relative overflow-hidden">

            <div class="absolute inset-0 bg-hero-pattern opacity-10"></div>
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-white/5 rounded-full blur-2xl"></div>

            <div class="relative flex flex-col justify-between p-12 w-full">

                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-white/15 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/20">
                        <i data-lucide="clipboard-check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-lg font-bold text-white">CandidatureTracker</span>
                </a>

                <div class="animate-fade-up">
                    <h2 class="text-3xl font-extrabold text-white mb-6 leading-snug">
                        Rejoignez des centaines<br>de candidats
                        <span class="text-purple-200">organisés.</span>
                    </h2>

                    <div class="space-y-4">
                        @foreach([
                            ['check-circle', 'Suivi illimité de candidatures'],
                            ['calendar-check', 'Gestion complète des entretiens'],
                            ['filter', 'Filtres et archives intelligents'],
                            ['shield-check', 'Données personnelles et sécurisées'],
                        ] as [$icon, $feature])
                            <div class="flex items-center gap-3 animate-fade-up-delay-1">
                                <div class="w-8 h-8 bg-white/10 backdrop-blur-md rounded-lg flex items-center justify-center border border-white/20 shrink-0">
                                    <i data-lucide="{{ $icon }}" class="w-4 h-4 text-white"></i>
                                </div>
                                <span class="text-sm text-purple-100">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/10 animate-fade-up-delay-3">
                    <div class="flex items-center gap-1 mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="w-4 h-4 text-amber-400 fill-amber-400"></i>
                        @endfor
                    </div>
                    <p class="text-sm text-purple-100 mb-3 italic leading-relaxed">
                        "J'ai trouvé mon emploi idéal grâce à cette organisation. Plus aucun oubli !"
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <span class="text-xs font-bold text-white">SL</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-white">Sarah L.</p>
                            <p class="text-xs text-purple-200">Développeuse Frontend</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- RIGHT — Form --}}
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-8 lg:px-16 py-12">
            <div class="max-w-sm w-full mx-auto animate-fade-up">

                {{-- Mobile logo --}}
                <div class="lg:hidden mb-10">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center">
                            <i data-lucide="clipboard-check" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-lg font-bold text-gray-900">CandidatureTracker</span>
                    </a>
                </div>

                <h1 class="text-2xl font-extrabold text-gray-900 mb-1">Créer un compte</h1>
                <p class="text-sm text-gray-500 mb-8">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-700 transition-colors">
                        Se connecter
                    </a>
                </p>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="form-label">Nom complet</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input id="name" type="text" name="name"
                                   value="{{ old('name') }}" required autofocus
                                   placeholder="Jean Dupont"
                                   class="form-input pl-11 @error('name') border-red-300 @enderror">
                        </div>
                        @error('name')
                            <p class="form-error">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email"
                                   value="{{ old('email') }}" required
                                   placeholder="vous@exemple.fr"
                                   class="form-input pl-11 @error('email') border-red-300 @enderror">
                        </div>
                        @error('email')
                            <p class="form-error">
                                <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="relative" x-data="{ show: false }">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input id="password"
                                   :type="show ? 'text' : 'password'"
                                   name="password" required
                                   placeholder="Minimum 8 caractères"
                                   class="form-input pl-11 pr-11 @error('password') border-red-300 @enderror">
                            <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition-colors">
                                <i x-show="!show" data-lucide="eye" class="w-4 h-4"></i>
                                <i x-show="show" data-lucide="eye-off" class="w-4 h-4"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                            </div>
                            <input id="password_confirmation" type="password"
                                   name="password_confirmation" required
                                   placeholder="Répétez votre mot de passe"
                                   class="form-input pl-11">
                        </div>
                    </div>

                    <button type="submit" class="btn-primary w-full py-3">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Créer mon compte
                    </button>

                </form>

            </div>
        </div>

    </div>

</body>
</html>