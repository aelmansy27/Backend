<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    public function treatmentStock(){
        return $this->belongsTo(TreatmentStock::class);
    }

    public function treatmentDoseTimes(){
        return $this->hasMany(TreatmentDoseTime::class);
    }
}
