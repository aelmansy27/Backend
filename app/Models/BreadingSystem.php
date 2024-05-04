<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BreadingSystem extends Model implements Auditable
{
    use HasFactory;
    use  \OwenIt\Auditing\Auditable;

    public function activitySystems()
    {
        return $this->hasMany(ActivitySystem::class);
    }

    public function cowFeeds()
    {
        return $this->hasMany(CowFeed::class);
    }


}
