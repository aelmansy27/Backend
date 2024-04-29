<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CowSensor extends Model
{
    use HasFactory;
    protected $fillable=['cow_id','sensor_id','values'];
    public function cow(){
        return $this->belongsTo(Cow::class);
    }

    public function sensor(){
        return $this->belongsTo(Sensor::class);
    }

}
