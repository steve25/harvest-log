<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function crops()
    {
        return $this->belongsToMany(Crop::class, 'field_crops')
            ->withPivot('hectares')
            ->withTimestamps();
    }
}
