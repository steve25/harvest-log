<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    public function fields()
    {
        return $this->belongsToMany(Field::class, 'field_crops')
            ->withPivot('hectares')
            ->withTimestamps();
    }
}
