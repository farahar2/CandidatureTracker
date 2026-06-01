<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CandidatureTracker — Suivez vos candidatures intelligemment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white antialiased overflow-x-hidden"
      x-data="{ scrolled: false }"
      @scroll.window="scrolled = window.scrollY > 20">

    {{-- ===== NAVBAR ===== --}}
    <nav class="fixed top-0 w-full z-50 transition-all duration-300"
         :class="scrolled ? 'bg-white/80 backdrop-blur-xl border-b border-gray-200/50 shadow-sm' : 'bg-transparent'">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">

                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:shadow-indigo-500/40 transition-shadow">
                        <i data-lucide="clipboard-check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-lg font-bold bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                        CandidatureTracker
                    </span>
                </a>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            Tableau de bord
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost hidden sm:inline-flex">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Commencer
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    {{-- ===== HERO ===== --}}
    <section class="relative min-h-screen flex items-center pt-16 overflow-hidden">

        {{-- Background decorations --}}
        <div class="absolute inset-0 bg-hero-pattern"></div>
        <div class="absolute top-20 left-1/4 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-40 animate-pulse-soft"></div>
        <div class="absolute bottom-20 right-1/4 w-96 h-96 bg-purple-100 rounded-full blur-3xl opacity-30 animate-pulse-soft" style="animation-delay: 1.5s"></div>
        <div class="absolute top-1/3 right-10 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-20 animate-float-delayed"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 py-20">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                {{-- Left: Content --}}
                <div>
                    {{-- Badge --}}
                    <div class="animate-fade-up">
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-100 rounded-full mb-8">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                            </span>
                            <span class="text-xs font-semibold text-indigo-700">
                                100% Gratuit — Organisez votre avenir
                            </span>
                        </div>
                    </div>

                    {{-- Title --}}
                    <h1 class="animate-fade-up-delay-1 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-[1.1] mb-6">
                        Votre recherche<br>d'emploi,
                        <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent animate-gradient bg-[length:200%_200%]">
                            simplifiée
                        </span>
                    </h1>

                    {{-- Subtitle --}}
                    <p class="animate-fade-up-delay-2 text-lg text-gray-500 max-w-lg mb-8 leading-relaxed">
                        Centralisez vos candidatures, planifiez vos entretiens et
                        ne laissez plus aucune opportunité vous échapper.
                    </p>

                    {{-- CTAs --}}
                    <div class="animate-fade-up-delay-3 flex flex-col sm:flex-row gap-3 mb-10">
                        @auth
                            <a href="{{ route('applications.index') }}" class="btn-primary px-8 py-3.5 text-base">
                                Mes candidatures
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary px-8 py-3.5 text-base">
                                Démarrer gratuitement
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </a>
                            <a href="{{ route('login') }}" class="btn-secondary px-8 py-3.5 text-base">
                                <i data-lucide="log-in" class="w-5 h-5"></i>
                                Se connecter
                            </a>
                        @endauth
                    </div>

                    {{-- Social proof --}}
                    <div class="animate-fade-up-delay-4 flex items-center gap-6">
                        <div class="flex -space-x-2">
                            @foreach(['bg-indigo-400', 'bg-purple-400', 'bg-blue-400', 'bg-emerald-400'] as $color)
                                <div class="w-8 h-8 {{ $color }} rounded-full border-2 border-white flex items-center justify-center">
                                    <i data-lucide="user" class="w-3.5 h-3.5 text-white"></i>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-sm">
                            <span class="font-semibold text-gray-900">500+</span>
                            <span class="text-gray-500"> candidats actifs</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Hero Visual --}}
                <div class="animate-fade-up-delay-2 relative hidden lg:block">

                    {{-- Floating Card 1 --}}
                    <div class="absolute -top-4 -left-8 z-10 animate-float">
                        <div class="card-glass p-4 shadow-elevated">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Offre acceptée !</p>
                                    <p class="text-xs text-gray-500">Google — Senior Dev</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Main Dashboard Preview --}}
                    <div class="card p-6 shadow-elevated">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-sm font-bold text-gray-900">Mes candidatures</h3>
                                <p class="text-xs text-gray-400 mt-0.5">8 actives</p>
                            </div>
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            </div>
                        </div>

                        {{-- Mock rows --}}
                        @foreach([
                            ['Google', 'Dev Laravel', 'bg-emerald-50 text-emerald-700', 'Acceptée'],
                            ['Microsoft', 'Full Stack', 'bg-orange-50 text-orange-700', 'Entretien'],
                            ['Spotify', 'PHP Dev', 'bg-green-50 text-green-700', 'Offre reçue'],
                            ['Amazon', 'Backend', 'bg-purple-50 text-purple-700', 'Souhaitée'],
                        ] as [$company, $role, $badgeClass, $status])
                            <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center">
                                        <span class="text-xs font-bold text-indigo-600">{{ substr($company, 0, 2) }}</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $company }}</p>
                                        <p class="text-xs text-gray-400">{{ $role }}</p>
                                    </div>
                                </div>
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Floating Card 2 --}}
                    <div class="absolute -bottom-6 -right-6 z-10 animate-float-delayed">
                        <div class="card-glass p-4 shadow-elevated">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-amber-500 rounded-xl flex items-center justify-center">
                                    <i data-lucide="calendar" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">Entretien demain</p>
                                    <p class="text-xs text-gray-500">14:00 — Visioconférence</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>

    {{-- ===== STATS ===== --}}
    <section class="py-16 bg-gray-50/50 border-y border-gray-100"
             x-data="{
                 shown: false,
                 count1: 0, target1: 500,
                 count2: 0, target2: 2000,
                 count3: 0, target3: 98,
                 animateCounters() {
                     if (this.shown) return;
                     this.shown = true;
                     const duration = 2000;
                     const steps = 60;
                     const interval = duration / steps;
                     let step = 0;
                     const timer = setInterval(() => {
                         step++;
                         const progress = step / steps;
                         const ease = 1 - Math.pow(1 - progress, 3);
                         this.count1 = Math.round(this.target1 * ease);
                         this.count2 = Math.round(this.target2 * ease);
                         this.count3 = Math.round(this.target3 * ease);
                         if (step >= steps) clearInterval(timer);
                     }, interval);
                 }
             }"
             x-intersect.once="animateCounters()">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-3 gap-8 text-center">
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900" x-text="count1 + '+'">0+</p>
                    <p class="text-sm text-gray-500 mt-1">Utilisateurs actifs</p>
                </div>
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900" x-text="count2 + '+'">0+</p>
                    <p class="text-sm text-gray-500 mt-1">Candidatures suivies</p>
                </div>
                <div>
                    <p class="text-3xl sm:text-4xl font-extrabold text-gray-900" x-text="count3 + '%'">0%</p>
                    <p class="text-sm text-gray-500 mt-1">Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FEATURES ===== --}}
    <section class="py-24 relative">

        <div class="absolute inset-0 bg-hero-pattern opacity-50"></div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 rounded-full text-xs font-semibold text-indigo-600 mb-4">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    Fonctionnalités
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
                    Tout ce qu'il faut pour<br>
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        décrocher le poste idéal
                    </span>
                </h2>
                <p class="text-gray-500 max-w-xl mx-auto">
                    Des outils simples mais puissants pour transformer votre recherche d'emploi.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach([
                    [
                        'icon' => 'file-text',
                        'gradient' => 'from-blue-500 to-indigo-600',
                        'glow' => 'group-hover:shadow-blue-500/20',
                        'title' => 'Suivi des candidatures',
                        'desc' => 'Enregistrez chaque candidature avec statut, priorité et toutes les informations essentielles.'
                    ],
                    [
                        'icon' => 'calendar-check',
                        'gradient' => 'from-orange-500 to-amber-600',
                        'glow' => 'group-hover:shadow-orange-500/20',
                        'title' => 'Gestion des entretiens',
                        'desc' => 'Planifiez, préparez et suivez tous vos entretiens avec notes et résultats.'
                    ],
                    [
                        'icon' => 'filter',
                        'gradient' => 'from-emerald-500 to-teal-600',
                        'glow' => 'group-hover:shadow-emerald-500/20',
                        'title' => 'Filtres avancés',
                        'desc' => 'Retrouvez instantanément n\'importe quelle candidature par statut ou priorité.'
                    ],
                    [
                        'icon' => 'archive',
                        'gradient' => 'from-purple-500 to-violet-600',
                        'glow' => 'group-hover:shadow-purple-500/20',
                        'title' => 'Archives intelligentes',
                        'desc' => 'Archivez les candidatures terminées et restaurez-les à tout moment.'
                    ],
                    [
                        'icon' => 'shield-check',
                        'gradient' => 'from-rose-500 to-pink-600',
                        'glow' => 'group-hover:shadow-rose-500/20',
                        'title' => 'Données privées',
                        'desc' => 'Vos candidatures sont protégées. Personne d\'autre ne peut y accéder.'
                    ],
                    [
                        'icon' => 'smartphone',
                        'gradient' => 'from-cyan-500 to-blue-600',
                        'glow' => 'group-hover:shadow-cyan-500/20',
                        'title' => 'Responsive',
                        'desc' => 'Accessible depuis votre ordinateur, tablette ou smartphone.'
                    ],
                ] as $feature)
                    <div class="card-interactive p-6 group {{ $feature['glow'] }}">
                        <div class="w-12 h-12 bg-gradient-to-br {{ $feature['gradient'] }} rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="{{ $feature['icon'] }}" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ===== TIMELINE ===== --}}
    <section class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-purple-50 rounded-full text-xs font-semibold text-purple-600 mb-4">
                    <i data-lucide="route" class="w-3.5 h-3.5"></i>
                    Processus
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">
                    Comment ça marche ?
                </h2>
                <p class="text-gray-500">
                    Trois étapes simples pour organiser votre recherche.
                </p>
            </div>

            <div class="relative">
                {{-- Vertical line --}}
                <div class="absolute left-8 top-0 bottom-0 w-px bg-gradient-to-b from-indigo-200 via-purple-200 to-emerald-200 hidden sm:block"></div>

                @foreach([
                    [
                        'step' => '01',
                        'gradient' => 'from-indigo-500 to-blue-600',
                        'title' => 'Ajoutez vos candidatures',
                        'desc' => 'Renseignez l\'entreprise, le poste, l\'URL de l\'offre et vos notes. Définissez le statut et la priorité.',
                        'icon' => 'plus-circle'
                    ],
                    [
                        'step' => '02',
                        'gradient' => 'from-purple-500 to-violet-600',
                        'title' => 'Planifiez vos entretiens',
                        'desc' => 'Ajoutez chaque entretien avec le type, la date, vos notes de préparation et le résultat.',
                        'icon' => 'calendar'
                    ],
                    [
                        'step' => '03',
                        'gradient' => 'from-emerald-500 to-teal-600',
                        'title' => 'Suivez votre progression',
                        'desc' => 'Filtrez, archivez et consultez vos statistiques pour garder une vision claire de votre recherche.',
                        'icon' => 'trending-up'
                    ],
                ] as $timeline)
                    <div class="relative flex gap-6 mb-12 last:mb-0 group">
                        {{-- Circle --}}
                        <div class="shrink-0 w-16 h-16 bg-gradient-to-br {{ $timeline['gradient'] }} rounded-2xl flex items-center justify-center shadow-lg z-10 group-hover:scale-110 transition-transform duration-300">
                            <i data-lucide="{{ $timeline['icon'] }}" class="w-7 h-7 text-white"></i>
                        </div>
                        {{-- Content --}}
                        <div class="card p-6 flex-1 group-hover:shadow-md transition-shadow duration-300">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider">
                                    Étape {{ $timeline['step'] }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $timeline['title'] }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $timeline['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ===== TESTIMONIALS ===== --}}
    <section class="py-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 rounded-full text-xs font-semibold text-amber-600 mb-4">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                    Témoignages
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">
                    Ils nous font confiance
                </h2>
            </div>

            <div class="grid sm:grid-cols-3 gap-6">
                @foreach([
                    [
                        'name' => 'Sarah L.',
                        'role' => 'Développeuse Frontend',
                        'text' => 'J\'ai décroché mon poste en 3 semaines grâce à une meilleure organisation de mes candidatures.',
                        'color' => 'indigo'
                    ],
                    [
                        'name' => 'Thomas M.',
                        'role' => 'Chef de projet',
                        'text' => 'Plus aucun oubli de relance. L\'outil est simple et fait exactement ce qu\'il faut.',
                        'color' => 'purple'
                    ],
                    [
                        'name' => 'Amira B.',
                        'role' => 'Data Analyst',
                        'text' => 'La vue par statut m\'a permis de visualiser clairement où j\'en étais dans chaque processus.',
                        'color' => 'emerald'
                    ],
                ] as $testimonial)
                    <div class="card-hover p-6">
                        <div class="flex items-center gap-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <i data-lucide="star" class="w-4 h-4 text-amber-400 fill-amber-400"></i>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed mb-6">
                            "{{ $testimonial['text'] }}"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-{{ $testimonial['color'] }}-100 rounded-full flex items-center justify-center">
                                <span class="text-sm font-bold text-{{ $testimonial['color'] }}-600">
                                    {{ substr($testimonial['name'], 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $testimonial['name'] }}</p>
                                <p class="text-xs text-gray-400">{{ $testimonial['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== FINAL CTA ===== --}}
    <section class="py-24 relative overflow-hidden">

        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-indigo-700"></div>
        <div class="absolute inset-0 bg-hero-pattern opacity-10"></div>

        {{-- Decorative circles --}}
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/5 rounded-full blur-xl"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-white/5 rounded-full blur-xl"></div>

        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-5">
                Prêt à organiser votre<br>recherche d'emploi ?
            </h2>
            <p class="text-indigo-100 text-lg mb-8 max-w-xl mx-auto">
                Créez votre compte en 30 secondes et commencez à suivre vos candidatures dès maintenant.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white text-indigo-700 font-semibold rounded-xl hover:bg-indigo-50 hover:shadow-xl hover:shadow-black/10 active:scale-[0.98] transition-all duration-200">
                    Créer mon compte
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center gap-2 px-8 py-3.5 text-white border border-white/30 font-semibold rounded-xl hover:bg-white/10 transition-all duration-200">
                    Se connecter
                </a>
            </div>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="py-10 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="clipboard-check" class="w-4 h-4 text-white"></i>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">CandidatureTracker</span>
                </div>
                <p class="text-xs text-gray-400">© {{ date('Y') }} CandidatureTracker — Tous droits réservés.</p>
            </div>
        </div>
    </footer>

</body>
</html>