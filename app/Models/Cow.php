<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;


class Cow extends Model
{
    use HasFactory;
    use LogsActivity;

    // use  \OwenIt\Auditing\Auditable;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cow) {
            $cow->cowId = sprintf("%06d", mt_rand(1, 999999));
        });
    }


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

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
    public function notes(){
        return $this->hasMany(Note::class);
    }

}
