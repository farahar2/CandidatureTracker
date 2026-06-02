<x-guest-layout>
    <h2 class="text-lg font-bold text-gray-900 mb-2">Vérifiez votre email</h2>
    <p class="text-sm text-gray-500 mb-6">
        Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse email
        en cliquant sur le lien que nous venons de vous envoyer.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert-success mb-5">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Un nouveau lien de vérification a été envoyé à votre adresse email.
        </div>
    @endif

    <div class="flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary btn-sm">
                Renvoyer l'email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-ghost btn-sm">
                Déconnexion
            </button>
        </form>
    </div>
</x-guest-layout>
