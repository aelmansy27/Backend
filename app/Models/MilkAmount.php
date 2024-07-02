<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MilkAmount extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded=[];

    public function cow(){
        return $this->belongsTo(Cow::class);
    }

    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
