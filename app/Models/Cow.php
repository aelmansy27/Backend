<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;


    public function activityPlace()
    {
        return $this->belongsTo(ActivityPlace::class);
    }
    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class);
    }

    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class);
    }

    public function cowSensors(){
        return $this->hasMany(CowSensor::class);
    }

    public function purpose(){
        return $this->belongsTo(Purpose::class);
    }
}
