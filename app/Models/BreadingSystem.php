<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreadingSystem extends Model
{
    use HasFactory;

    public function activitySystems()
    {
        return $this->hasMany(ActivitySystem::class);
    }

    public function cowFeeds()
    {
        return $this->hasMany(CowFeed::class);
    }
    public function cows()
    {
        return $this->hasMany(Cow::class,'breadingsystem_id');
    }


}
