<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weighing extends Model
{
    protected $fillable = [
        'vehicle_id',
        'field_crop_id',
        'brutto_kg',
        'netto_kg',
        'tara_kg',
        'recorded_at',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function fieldCrop()
    {
        return $this->belongsTo(FieldCrop::class);
    }
}
