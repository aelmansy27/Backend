<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySystem extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function cows()
    {
        return $this->hasMany(Cow::class,'activitysystem_id');
    }

    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class);
    }

    public function activityPlaces()
    {
        return $this->hasMany(ActivityPlace::class);
    }
    public function walkingDates()
    {
        return $this->hasMany(WalkingDate::class);
    }

    public function milkingDates()
    {
        return $this->hasMany(MilkingDate::class);
    }

    public function drinkingDates()
    {
        return $this->hasMany(DrinkingDate::class);
    }

}

