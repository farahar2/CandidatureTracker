<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    /**
     * Un utilisateur peut voir uniquement ses propres candidatures.
     */
    public function view(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Un utilisateur peut modifier uniquement ses propres candidatures.
     */
    public function update(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Un utilisateur peut archiver uniquement ses propres candidatures.
     */
    public function delete(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }

    /**
     * Un utilisateur peut restaurer uniquement ses propres candidatures.
     */
    public function restore(User $user, Application $application): bool
    {
        return $user->id === $application->user_id;
    }
}