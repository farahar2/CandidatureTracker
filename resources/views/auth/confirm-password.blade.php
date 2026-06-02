<x-guest-layout>
    <h2 class="text-lg font-bold text-gray-900 mb-2">Confirmez votre mot de passe</h2>
    <p class="text-sm text-gray-500 mb-6">
        Cette zone est sécurisée. Veuillez confirmer votre mot de passe avant de continuer.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="Votre mot de passe"
                   class="{{ $errors->has('password') ? 'form-input-error' : 'form-input' }}">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="btn-primary">
                Confirmer
            </button>
        </div>
    </form>
</x-guest-layout>
