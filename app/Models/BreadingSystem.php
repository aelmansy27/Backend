<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BreadingSystem extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded=[];
    public $timestamps=true;

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
        return $this->hasMany(Cow::class);
    }

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

}
