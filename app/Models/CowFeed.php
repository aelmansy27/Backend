<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CowFeed extends Model
{
    use HasFactory;
    use  LogsActivity;

    protected $guarded=[];

    public $timestamps=true;

    public function cow()
    {
        return $this->belongsTo(Cow::class,'cow_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function feedStock()
    {
        return $this->belongsTo(FeedStock::class,'feed_stock_id');
    }
    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class,'breading_system_id');
    }
    public function eatingDates()
    {
        return $this->hasMany(EatingDate::class);
    }

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
