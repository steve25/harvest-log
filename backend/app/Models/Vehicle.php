<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public function weighings()
    {
        return $this->hasMany(Weighing::class);
    }
}
