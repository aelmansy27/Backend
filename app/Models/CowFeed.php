<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CowFeed extends Model
{
    use HasFactory;

    public function cow()
    {
        return $this->belongsTo(Cow::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function feedStock()
    {
        return $this->belongsTo(FeedStock::class);
    }
    public function breadingSystem()
    {
        return $this->belongsTo(BreadingSystem::class);
    }
    public function eatingDates()
    {
        return $this->hasMany(EatingDate::class);
    }
}
