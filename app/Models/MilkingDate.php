<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilkingDate extends Model
{
    use HasFactory;

    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class);
    }
}
