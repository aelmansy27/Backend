<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ActivitySystem extends Model
{
    use HasFactory;
    use  LogsActivity;

    protected $guarded=[];
    public $timestamps=true;

    public function cows()
    {
        return $this->hasMany(Cow::class,'activity_system_id');
    }

    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class,'breading_system_id');
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

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

