<?php

namespace App\Models;

use App\Enums\ActivityType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ActivityPlace extends Model
{
    use HasFactory;
    use  LogsActivity;
    protected $guarded=[];
    public $timestamps=true;

    public function cows()
    {
        return $this->hasMany(Cow::class);
    }

    public function activitySystem()
    {
        return $this->belongsTo(ActivitySystem::class,'activity_system_id');
    }
    protected  $casts=[
        'type'=>ActivityType::class
    ];

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
