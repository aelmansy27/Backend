<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Cow extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];
    public $timestamps=true;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cow) {
            $cow->cowId = sprintf("%06d", mt_rand(1, 999999));
        });
    }


    public function activityPlace()
    {
        return $this->belongsTo(ActivityPlace::class,'activity_place_id');
    }

    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class,'activity_system_id');
    }

    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class,'breading_system_id');
    }

    public function cowSensors()
    {
        return $this->hasMany(CowSensor::class);
    }

    public function purpose()
    {
        return $this->belongsTo(Purpose::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function notes(){
        return $this->hasMany(Note::class);
    }
    public function milkAmounts(){
        return $this->hasMany(MilkAmount::class);
    }

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

}
