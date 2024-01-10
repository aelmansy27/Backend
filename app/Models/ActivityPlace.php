<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPlace extends Model
{
    use HasFactory;

    protected  $casts=[
        'type'=>ActivityType::class
    ];

    public function cows()
    {
        return $this->hasMany(Cow::class);
    }

    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class);
    }
}
