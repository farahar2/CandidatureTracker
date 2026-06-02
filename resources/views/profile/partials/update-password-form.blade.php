<section>
    <header class="mb-6">
        <h2 class="section-title">Mot de passe</h2>
        <p class="text-sm text-gray-500 mt-1">Assurez la sécurité de votre compte avec un mot de passe fort.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label class="form-label">Mot de passe actuel</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-input" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="form-label">Nouveau mot de passe</label>
            <input id="update_password_password" name="password" type="password" class="form-input" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="form-label">Confirmer le mot de passe</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">Enregistrer</button>

            @if (session('status') === 'password-updated')
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
