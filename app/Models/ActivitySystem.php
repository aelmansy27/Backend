<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySystem extends Model
{
    use HasFactory;

    public function cows()
    {
        return $this->hasMany(Cow::class);
    }

    public function eatingDates()
    {
        return $this->hasMany(EatingDate::class);
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

