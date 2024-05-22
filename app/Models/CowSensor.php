<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CowSensor extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable=['cow_id','sensor_id','values'];
    public function cow(){
        return $this->belongsTo(Cow::class);
    }


    public function sensor(){
        return $this->belongsTo(Sensor::class);
    }

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
}
