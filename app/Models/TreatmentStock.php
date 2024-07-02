<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TreatmentStock extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded=[];

    public $timestamps=true;

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }

    public function treatments(){
        return $this->hasMany(Treatment::class);
    }

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
