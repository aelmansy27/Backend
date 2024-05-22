<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EatingDate extends Model
{
    use HasFactory;

    public function cowFeed()
    {
        return $this->belongsTo(CowFeed::class);
    }
}
