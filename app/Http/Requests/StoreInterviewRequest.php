<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequest extends FormRequest
{
    /**
     * L'autorisation est gérée par la Policy.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation pour la création d'un entretien.
     */
    public function rules(): array
    {
        return [
            'application_id' => ['required', 'exists:applications,id'],
            'type'           => ['required', 'in:phone,video,onsite,technical,hr'],
            'scheduled_at'   => ['required', 'date'],
            'notes'          => ['nullable', 'string'],
            'result'         => ['required', 'in:pending,passed,failed'],
        ];
    }

    /**
     * Messages de validation en français.
     */
    public function messages(): array
    {
        return [
            'application_id.required' => 'La candidature est obligatoire.',
            'application_id.exists'   => 'La candidature sélectionnée est invalide.',
            'type.required'           => 'Le type d\'entretien est obligatoire.',
            'type.in'                 => 'Le type sélectionné est invalide.',
            'scheduled_at.required'   => 'La date et l\'heure sont obligatoires.',
            'scheduled_at.date'       => 'La date doit être une date valide.',
            'result.required'         => 'Le résultat est obligatoire.',
            'result.in'               => 'Le résultat sélectionné est invalide.',
        ];
    }
}