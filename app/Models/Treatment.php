<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Treatment extends Model
{
    use HasFactory;
    use  LogsActivity;

    protected $guarded=[];

    public $timestamps=true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    public function treatmentStock(){
        return $this->belongsTo(TreatmentStock::class,'treatment_stock_id');
    }

    public function treatmentDoseTimes(){
        return $this->hasMany(TreatmentDoseTimes::class);
    }

    public function cow(){
        return $this->belongsTo(Cow::class,'cow_id');
    }
}
