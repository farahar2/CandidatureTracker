<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interview extends Model
{
    // -------------------------------------------------------------------------
    // Constantes d'affichage (stocké en anglais, affiché en français)
    // -------------------------------------------------------------------------

    const TYPE_LABELS = [
        'phone'     => 'Téléphonique',
        'video'     => 'Visioconférence',
        'onsite'    => 'Présentiel',
        'technical' => 'Technique',
        'hr'        => 'RH',
    ];

    const RESULT_LABELS = [
        'pending' => 'En attente',
        'passed'  => 'Réussi',
        'failed'  => 'Échoué',
    ];

    const RESULT_COLORS = [
        'pending' => 'gray',
        'passed'  => 'green',
        'failed'  => 'red',
    ];

    // -------------------------------------------------------------------------
    // Champs remplissables
    // -------------------------------------------------------------------------

    protected $fillable = [
        'application_id',
        'type',
        'scheduled_at',
        'notes',
        'result',
    ];

    // -------------------------------------------------------------------------
    // Cast des types
    // -------------------------------------------------------------------------

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // -------------------------------------------------------------------------
    // Relations
    // -------------------------------------------------------------------------

    /**
     * Un entretien appartient à une candidature.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    // -------------------------------------------------------------------------
    // Accesseurs d'affichage
    // -------------------------------------------------------------------------

    /**
     * Retourne le label français du type.
     */
    public function getTypeLabelAttribute(): string
    {
        return self::TYPE_LABELS[$this->type] ?? $this->type;
    }

    /**
     * Retourne le label français du résultat.
     */
    public function getResultLabelAttribute(): string
    {
        return self::RESULT_LABELS[$this->result] ?? $this->result;
    }

    /**
     * Retourne la couleur Tailwind du résultat.
     */
    public function getResultColorAttribute(): string
    {
        return self::RESULT_COLORS[$this->result] ?? 'gray';
    }
}