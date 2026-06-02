<section>
    <header class="mb-6">
        <h2 class="section-title text-red-600">Supprimer le compte</h2>
        <p class="text-sm text-gray-500 mt-1">
            Une fois votre compte supprimé, toutes ses données seront effacées définitivement.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger"
    >Supprimer mon compte</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-gray-900 mb-2">
                Êtes-vous sûr de vouloir supprimer votre compte ?
            </h2>

            <p class="text-sm text-gray-500">
                Cette action est irréversible. Veuillez entrer votre mot de passe pour confirmer.
            </p>

            <div class="mt-6">
                <label for="password" class="form-label">Mot de passe</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input"
                    placeholder="Votre mot de passe"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="btn-secondary">Annuler</button>
                <button type="submit" class="btn-danger">Supprimer définitivement</button>
            </div>
        </form>
    </x-modal>
</section>
