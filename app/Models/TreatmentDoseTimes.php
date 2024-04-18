<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentDoseTimes extends Model
{
    use HasFactory;
    protected $fillable=[];

    public function treatment(){
        return $this->belongsTo(Treatment::class);
    }
}
