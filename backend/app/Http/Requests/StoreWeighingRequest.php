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
            'storage_id' => 'required|exists:storages,id',
            'coming_weight_kg' => 'required|numeric',
            'leaving_weight_kg' => 'nullable|numeric',
            'netto_weight_kg' => 'nullable|numeric',
            'bulk_density' => 'nullable|numeric',
            'moisture' => 'nullable|numeric',
            'start_record_at' => 'required|date_format:Y-m-d H:i:s',
            'recorded_at' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
