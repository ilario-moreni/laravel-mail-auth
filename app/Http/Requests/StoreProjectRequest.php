<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
            'title' => ['required', 'max:50'],
            'description' => ['required'],
            'members_num' => ['required'],
            'budget' => ['required'],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'description.required' => 'La descrizione è obbligatoria',
            'members_num.required' => 'Il numero di partecipanti è obbligatorio',
            'budget.required' => 'Il budget è da dichiarare',
        ];
    }
}