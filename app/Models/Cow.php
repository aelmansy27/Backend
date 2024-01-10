<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cow){
            $cow->cowId=sprintf("%06d",mt_rand(1,999999));
        });
    }

    public function activityPlace()
    {
        return $this->belongsTo(ActivityPlace::class,'activityplace_id');
    }
    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class);
    }

    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class);
    }
}
