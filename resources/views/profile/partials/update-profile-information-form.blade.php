<section>
    <header class="mb-6">
        <h2 class="section-title">Informations personnelles</h2>
        <p class="text-sm text-gray-500 mt-1">Mettez à jour vos informations et votre adresse email.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label class="form-label">Nom complet</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="form-input">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label class="form-label">Adresse email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="form-input">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-gray-600">
                        Votre adresse email n'est pas vérifiée.

                        <button form="send-verification" class="underline text-sm text-blue-600 font-medium hover:text-blue-700">
                            Renvoyer l'email de vérification
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-emerald-600">
                            Un nouveau lien de vérification a été envoyé.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">Enregistrer</button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-emerald-600 font-medium"
                >Enregistré ✓</span>
            @endif
        </div>
    </form>
</section>
