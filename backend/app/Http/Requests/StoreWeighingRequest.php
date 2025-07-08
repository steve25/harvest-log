<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeighingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'field_crop_id' => 'required|exists:field_crops,id',
            'brutto_kg' => 'nullable|numeric',
            'netto_kg' => 'nullable|numeric',
            'tara_kg' => 'nullable|numeric',
            'recorded_at' => 'nullable|date',
        ];
    }
}
