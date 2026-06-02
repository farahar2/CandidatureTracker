<x-guest-layout>
    <h2 class="text-lg font-bold text-gray-900 mb-2">Mot de passe oublié ?</h2>
    <p class="text-sm text-gray-500 mb-6">
        Saisissez votre adresse email et nous vous enverrons un lien de réinitialisation.
    </p>

    @if (session('status'))
        <div class="alert-success mb-5">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   placeholder="vous@exemple.fr"
                   class="{{ $errors->has('email') ? 'form-input-error' : 'form-input' }}">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn-primary">
                Envoyer le lien
            </button>
        </div>
    </form>
</x-guest-layout>
