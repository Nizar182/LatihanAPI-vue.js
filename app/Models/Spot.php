<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    public function spot_vaccines(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SpotVaccine::class);
    }

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }
}
