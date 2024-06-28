<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EatingDate extends Model
{
    use HasFactory;
    use  LogsActivity;

    public $timestamps=true;

    public function cowFeed()
    {
        return $this->belongsTo(CowFeed::class,'cow_feed_id');
    }
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
