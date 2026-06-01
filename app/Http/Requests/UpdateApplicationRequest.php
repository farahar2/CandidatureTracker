<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    /**
     * L'autorisation est gérée par la Policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la modification.
     * Identiques à la création pour ce projet.
     */
    public function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'position'     => ['required', 'string', 'max:255'],
            'offer_url'    => ['nullable', 'url', 'max:2048'],
            'status'       => ['required', 'in:wishlist,applied,interview,offer,rejected,accepted'],
            'priority'     => ['required', 'in:low,medium,high'],
            'notes'        => ['nullable', 'string'],
            'applied_at'   => ['required', 'date'],
        ];
    }

    /**
     * Messages de validation en français.
     */
    public function messages(): array
    {
        return [
            'company_name.required' => 'Le nom de l\'entreprise est obligatoire.',
            'company_name.max'      => 'Le nom de l\'entreprise ne peut pas dépasser 255 caractères.',
            'position.required'     => 'Le poste visé est obligatoire.',
            'position.max'          => 'Le poste visé ne peut pas dépasser 255 caractères.',
            'offer_url.url'         => 'L\'URL de l\'offre doit être une adresse valide.',
            'status.required'       => 'Le statut est obligatoire.',
            'status.in'             => 'Le statut sélectionné est invalide.',
            'priority.required'     => 'La priorité est obligatoire.',
            'priority.in'           => 'La priorité sélectionnée est invalide.',
            'applied_at.required'   => 'La date de candidature est obligatoire.',
            'applied_at.date'       => 'La date de candidature doit être une date valide.',
        ];
    }
}