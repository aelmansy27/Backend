<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Note extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table='notes';
    protected $guarded=[];

    public $timestamps=true;

    public function cow()
    {
        return $this->belongsTo(Cow::class, 'note_id');
    }
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

