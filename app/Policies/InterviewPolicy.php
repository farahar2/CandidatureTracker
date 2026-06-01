<?php

namespace App\Policies;

use App\Models\Interview;
use App\Models\User;

class InterviewPolicy
{
    /**
     * Un utilisateur peut modifier uniquement les entretiens
     * de ses propres candidatures.
     */
    public function update(User $user, Interview $interview): bool
    {
        return $user->id === $interview->application->user_id;
    }

    /**
     * Un utilisateur peut supprimer uniquement les entretiens
     * de ses propres candidatures.
     */
    public function delete(User $user, Interview $interview): bool
    {
        return $user->id === $interview->application->user_id;
    }
}