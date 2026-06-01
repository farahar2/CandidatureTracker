<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    // -------------------------------------------------------------------------
    // Constantes d'affichage (stocké en anglais, affiché en français)
    // -------------------------------------------------------------------------

    const STATUS_LABELS = [
        'wishlist'  => 'Souhaitée',
        'applied'   => 'Candidature envoyée',
        'interview' => 'Entretien',
        'offer'     => 'Offre reçue',
        'rejected'  => 'Refusée',
        'accepted'  => 'Acceptée',
    ];

    const PRIORITY_LABELS = [
        'low'    => 'Basse',
        'medium' => 'Moyenne',
        'high'   => 'Haute',
    ];

    const STATUS_COLORS = [
        'wishlist'  => 'gray',
        'applied'   => 'blue',
        'interview' => 'yellow',
        'offer'     => 'green',
        'rejected'  => 'red',
        'accepted'  => 'green',
    ];

    const PRIORITY_COLORS = [
        'low'    => 'gray',
        'medium' => 'blue',
        'high'   => 'red',
    ];

    // -------------------------------------------------------------------------
    // Champs remplissables (protection contre mass assignment)
    // -------------------------------------------------------------------------

    protected $fillable = [
        'user_id',
        'company_name',
        'position',
        'offer_url',
        'status',
        'priority',
        'notes',
        'applied_at',
    ];

    // -------------------------------------------------------------------------
    // Cast des types
    // -------------------------------------------------------------------------

    protected $casts = [
        'applied_at' => 'date',
    ];

    // -------------------------------------------------------------------------
    // Relations
    // -------------------------------------------------------------------------

    /**
     * Une candidature appartient à un utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Une candidature peut avoir plusieurs entretiens.
     */
    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class);
    }

    // -------------------------------------------------------------------------
    // Accesseurs d'affichage
    // -------------------------------------------------------------------------

    /**
     * Retourne le label français du statut.
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? $this->status;
    }

    /**
     * Retourne le label français de la priorité.
     */
    public function getPriorityLabelAttribute(): string
    {
        return self::PRIORITY_LABELS[$this->priority] ?? $this->priority;
    }

    /**
     * Retourne la couleur Tailwind du statut.
     */
    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->status] ?? 'gray';
    }

    /**
     * Retourne la couleur Tailwind de la priorité.
     */
    public function getPriorityColorAttribute(): string
    {
        return self::PRIORITY_COLORS[$this->priority] ?? 'gray';
    }
}