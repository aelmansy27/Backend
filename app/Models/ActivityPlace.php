<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPlace extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function cows()
    {
        return $this->hasMany(Cow::class,'activityplace_id');
    }

    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class);
    }
    protected  $casts=[
        'type'=>ActivityType::class
    ];
}
