<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societies extends Model
{
    use HasFactory;

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}
