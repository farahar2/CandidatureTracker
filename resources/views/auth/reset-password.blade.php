<x-guest-layout>
    <h2 class="text-lg font-bold text-gray-900 mb-2">Réinitialiser le mot de passe</h2>
    <p class="text-sm text-gray-500 mb-6">Choisissez un nouveau mot de passe sécurisé.</p>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-5">
            <div>
                <label for="email" class="form-label">Adresse email</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                       class="{{ $errors->has('email') ? 'form-input-error' : 'form-input' }}">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       placeholder="Minimum 8 caractères"
                       class="{{ $errors->has('password') ? 'form-input-error' : 'form-input' }}">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       placeholder="Confirmez votre mot de passe"
                       class="form-input">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn-primary">
                Réinitialiser
            </button>
        </div>
    </form>
</x-guest-layout>
