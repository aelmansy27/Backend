<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cow){
            $cow->cow_id=sprintf("%06d",mt_rand(1,999999));
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
}
