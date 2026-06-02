<x-app-layout>
    <x-slot name="header">
        <h1 class="page-title">Mon profil</h1>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        <div class="card p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="card p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="card p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
