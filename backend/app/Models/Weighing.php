<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weighing extends Model
{
    protected $fillable = [
        'vehicle_id',
        'field_crop_id',
        'coming_weight_kg',
        'leaving_weight_kg',
        'netto_weight_kg',
        'bulk_density',
        'moisture',
        'start_record_at',
        'recorded_at',
        'storage_id'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function fieldCrop()
    {
        return $this->belongsTo(FieldCrop::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }
}
